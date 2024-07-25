<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Libraries\Security;
use App\Models\UsersModel;

class Register extends BaseController {

    private $security;
    private $usersModel;

    public function __construct() {
        // Initialize the Security and UsersModel instances
        $this->security = new Security();
        $this->usersModel = new UsersModel();
    }

    /**
     * Display the registration page if the user is not logged in.
     * Redirect to profile page if the user is already logged in.
     */
    public function index() {
        // Redirect to profile if the user is already logged in
        if ($this->security->getUserId()) {
            return redirect()->to('account/profile/' . $this->security->getLoggedInUser()->username)
                            ->with('fail', "You already have an account.");
        }

        // Prepare data for view
        $data = [
            'pageTitle' => "Dashboard > Register | " . $this->settings->getKeyValue('website_name'),
            'themeUrl' => base_url('public/themes/NiceAdmin/')
        ];
        return view('register/closed', $data);
    }

    /**
     * Define the validation rules for the registration form.
     *
     * @return array Validation rules
     */
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

    /**
     * Define the custom error messages for the registration form validation.
     *
     * @return array Custom error messages
     */
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

    /**
     * Handle the registration process including validation, data saving, and email sending.
     */
    public function run() {
        // Perform form validation
        $validation = service('validation');
        $validation->setRules($this->_registerRules(), $this->_registerErrors());

        if ($validation->withRequest($this->request)->run()) {
            // Generate a verification token
            $verificationToken = bin2hex(random_bytes(32));

            // Save the user data in the database and get the user ID
            $userId = $this->saveUserData($verificationToken);

            // Send the verification email
            $this->sendVerificationEmail($userId, $verificationToken);

            // Set a flash message for successful registration
            session()->setFlashdata('success', 'Registration successful! Please check your email to activate your account.');

            // Redirect to the registration page or desired location
            return redirect()->to('register');
        } else {
            // Collect validation errors
            $errors = $validation->getErrors();

            // Preserve the entered data for the form
            $data = [
                'firstName' => $this->request->getPost('firstName'),
                'lastName' => $this->request->getPost('lastName'),
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('username')
            ];

            // Set flash message with errors and redirect back to the registration form
            session()->setFlashdata('errors', $errors);
            return redirect()->back()->withInput($data);
        }
    }

    /**
     * Clean the username by removing special characters and converting to lowercase.
     *
     * @param string $username The original username
     * @return string The cleaned username
     */
    private function cleanUsername($username) {
        // Remove special characters and spaces using regex
        $cleanedUsername = preg_replace('/[^a-z0-9_]/', '', $username);
        // Convert the username to lowercase and trim underscores from start and end
        return trim(strtolower($cleanedUsername), '_');
    }

    /**
     * Save user data to the database.
     *
     * @param string $verificationToken The verification token
     * @return int The user ID of the newly created user
     */
    private function saveUserData($verificationToken) {
        $cleanUsername = $this->cleanUsername($this->request->getPost('username'));

        // Prepare data for insertion
        $data = [
            'email' => $this->request->getPost('email'),
            'username' => $cleanUsername,
            'hash_pass' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'status' => 'inactive', // Initial status set as inactive
            'verification_token' => $verificationToken,
            'role' => 'default', // Default role for new users
        ];

        // Insert data into users table
        $this->usersModel->insert($data);

        // Return the last inserted ID
        return $this->usersModel->insertID();
    }

    /**
     * Send a verification email to the user.
     *
     * @param int $userId The user ID
     * @param string $verificationToken The verification token
     */
    private function sendVerificationEmail($userId, $verificationToken) {
        $mail = new PHPMailer(true);

        try {
            // Configure SMTP settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
            $mail->isSMTP(); // Use SMTP
            $mail->Host = 'mail.creativeigniter.com'; // SMTP server
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'test@creativeigniter.com'; // SMTP username
            $mail->Password = '6L]GPr.uZ(Gi'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption
            $mail->Port = 465; // SMTP port
            // Set email sender and recipient
            $mail->setFrom('test@creativeigniter.com', 'CreativeIgniter.com');
            $mail->addAddress($this->request->getPost('email'));

            // Set email format to HTML and define subject
            $mail->isHTML(true);
            $mail->Subject = 'Account Activation';

            // Generate the activation link
            $activationLink = base_url('activate/') . $verificationToken;

            // HTML and plain text versions of the message
            $htmlMessage = '<!doctype html><html><body>';
            $htmlMessage .= 'Hello, <br><br>';
            $htmlMessage .= 'Thank you for registering on our website. Please click the following link to activate your account:<br>';
            $htmlMessage .= '<a href="' . $activationLink . '">' . $activationLink . '</a><br><br>';
            $htmlMessage .= 'If you did not register on our website, please ignore this email.<br><br>';
            $htmlMessage .= 'Best regards,<br>Your Website Team';
            $htmlMessage .= '</body></html>';

            $plainMessage = 'Hello, ';
            $plainMessage .= 'Thank you for registering on our website. ';
            $plainMessage .= 'Please copy and paste the following link into your browser to activate your account: ';
            $plainMessage .= $activationLink;
            $plainMessage .= ' If you did not register on our website, please ignore this email.';

            // Set email body
            $mail->Body = $htmlMessage;
            $mail->AltBody = $plainMessage;

            // Send the email
            $mail->send();
        } catch (Exception $e) {
            // Log email sending errors
            log_message('error', "Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
