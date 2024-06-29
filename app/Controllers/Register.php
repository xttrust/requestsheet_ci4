<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use App\Libraries\Security;
use App\Models\UsersModel;

class Register extends BaseController {

    private $security;
    private $usersModel;

    public function __construct() {
        $this->security = new Security();
        $this->usersModel = new UsersModel();
    }

    public function index() {
        // Authenticate the user or redirect to login
        if ($this->security->getUserId()) {
            return redirect()->to('account/profile/' . $this->security->getLoggedInUser()->username)
                            ->with('fail', "You already have an account.");
        }

        $data = [
            'pageTitle' => "Dashboard > Register | " . $this->settings->getKeyValue('website_name'),
            'themeUrl' => base_url('public/themes/NiceAdmin/')
        ];
        return view('register/closed', $data);
    }

    private function _registerRules() {
        return [
            'firstName' => 'required|min_length[2]|max_length[50]',
            'lastName' => 'required|min_length[2]|max_length[50]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|min_length[4]|max_length[20]|is_unique[users.username]',
            'password' => 'required|min_length[6]|max_length[30]',
            'confirmPassword' => 'required|matches[password]',
            'terms' => 'required'
        ];
    }

    private function _registerErrors() {
        return [
            'firstName' => [
                'required' => 'Your first name is required!',
                'min_length' => 'Your first name should be at least 2 characters long.',
                'max_length' => 'Your first name should be max 50 characters long.'
            ],
            'lastName' => [
                'required' => 'Your last name is required!',
                'min_length' => 'Your last name should be at least 2 characters long.',
                'max_length' => 'Your last name should be max 50 characters long.'
            ],
            'email' => [
                'required' => 'Your email address is required!',
                'valid_email' => 'Please enter a valid email address.',
                'is_unique' => 'The email address is already registered.'
            ],
            'username' => [
                'required' => 'Your username is required!',
                'is_unique' => 'The username is already taken.',
                'min_length' => 'Your username should be at least 4 characters long.',
                'max_length' => 'Your username should be max 20 characters long.'
            ],
            'password' => [
                'required' => 'Your password is required!',
                'min_length' => 'Your password should be at least 6 characters long.',
                'max_length' => 'Your password should be max 30 characters long.'
            ],
            'confirmPassword' => [
                'required' => 'Please confirm your password!',
                'matches' => 'The password confirmation does not match.'
            ],
            'terms' => [
                'required' => 'You must agree to the terms and conditions before submitting.'
            ]
        ];
    }

    public function run() {
        // Perform form validation
        $validation = service('validation');
        $validation->setRules($this->_registerRules(), $this->_registerErrors());

        if ($validation->withRequest($this->request)->run()) {
            // Generate a verification token
            $verificationToken = bin2hex(random_bytes(32));

            // Save the user data in the database
            $userId = $this->saveUserData($verificationToken);

            // Send the verification email
            $this->sendVerificationEmail($userId, $verificationToken);

            // Set flash message to be shown after successful registration
            session()->setFlashdata('success', 'Registration successful! Please check your email to activate your account.');

            // Redirect to a success page or desired location
            return redirect()->to('register');
        } else {
            $errors = $validation->getErrors();

            // Preserve the entered data for the form
            $data = [
                'firstName' => $this->request->getPost('firstName'),
                'lastName' => $this->request->getPost('lastName'),
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('username')
            ];

            // Set flash message with errors
            session()->setFlashdata('errors', $errors);

            // Redirect back to the registration form with preserved data
            return redirect()->back()->withInput($data);
        }
    }

    private function cleanUsername($username) {
        // Remove special characters, spaces, and bars using regex
        $cleanedUsername = preg_replace('/[^a-z0-9_]/', '', $username);
        // Convert the username to lowercase
        $cleanedUsername = strtolower($cleanedUsername);
        // Remove underscores from the start and end of the username
        $cleanedUsername = trim($cleanedUsername, '_');
        return $cleanedUsername;
    }

    private function saveUserData($verificationToken) {
        // Get the form data for users table
        $cleanUsername = $this->cleanUsername($this->request->getPost('username'));
        $dataForUsersTable = [
            'email' => $this->request->getPost('email'),
            'username' => $cleanUsername,
            'hash_pass' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'status' => 'inactive', // Set the initial status as "inactive"
            'verification_token' => $verificationToken,
            'role' => 6,
        ];

        // Insert data into users table
        $this->usersModel->insert($dataForUsersTable);

        // Get the last inserted ID, i.e., the user ID
        $lastInsertID = $this->usersModel->insertID();

        // Return the user ID
        return $lastInsertID;
    }

    private function sendVerificationEmail($userId, $verificationToken) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'mail.bestofcomponents.com';                  // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                     // Enable SMTP authentication
            $mail->Username = 'no-reply@bestofcomponents.com';          // SMTP username
            $mail->Password = ')Va$6-T?T_tj';                           // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
            $mail->Port = 465;                                          // TCP port to connect to
            // Recipients
            $mail->setFrom('no-reply@bestofcomponents.com', 'BestOfComponents.com');
            $mail->addAddress($this->request->getPost('email'));        // Add a recipient
            // Content
            $mail->isHTML(true);                                        // Set email format to HTML
            $mail->Subject = 'Account Activation';

            // Generate the activation link using the verification token
            $activationLink = base_url('activate/') . $verificationToken;

            $message = '<!doctype html>';
            $message .= '<html>';
            $message .= '<body>';
            $message .= 'Hello, <br><br>';
            $message .= 'Thank you for registering on our website. Please click the following link to activate your account:<br>';
            $message .= '<a href="' . $activationLink . '">' . $activationLink . '</a><br><br>';
            $message .= 'If you did not register on our website, please ignore this email.<br><br>';
            $message .= 'Best regards,<br>Your Website Team';
            $message .= '</body>';
            $message .= '</html>';

            $messageNoHTML = 'Hello, ';
            $messageNoHTML .= 'Thank you for registering on our website. ';
            $messageNoHTML .= 'Please copy and paste in your browser the following link to activate your account. ';
            $messageNoHTML .= $activationLink;
            $messageNoHTML .= ' If you did not register on our website, please ignore this email. ';

            $mail->Body = $message;
            $mail->AltBody = $messageNoHTML;

            $mail->send();
        } catch (Exception $e) {
            log_message('error', "Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
