<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use App\Models\UsersModel;

class Register extends BaseController {

    private $usersModel;

    public function __construct() {
        $this->usersModel = new UsersModel();
    }

    /**
     * Display the registration form.
     */
    public function index() {
        if ($this->appSecurity->getUserId()) {
            return redirect()->to('account?logged=true')
                            ->with('fail', 'You already have an account.');
        }
        $data = [
            'pageTitle' => 'Register | Requestsheet',
            'viewPath' => 'register',
            'loggedUser' => $this->appSecurity->getLoggedInUser()
        ];
        return $this->templates->frontend($data);
    }

    /**
     * Process the registration form submission.
     */
    public function register() {
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

    /**
     * Get registration rules.
     *
     * @return array
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
     * Get registration error messages.
     *
     * @return array
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
     * Clean and format the username.
     *
     * @param string $username
     * @return string
     */
    private function cleanUsername($username) {
        // Remove special characters, spaces, and bars using regex
        $cleanedUsername = preg_replace('/[^a-z0-9_]/', '', $username);
        // Convert the username to lowercase
        $cleanedUsername = strtolower($cleanedUsername);
        // Remove underscores from the start and end of the username
        $cleanedUsername = trim($cleanedUsername, '_');
        return $cleanedUsername;
    }

    /**
     * Save user data to the database.
     *
     * @param string $verificationToken
     * @return int
     */
    private function saveUserData($verificationToken) {
        // Get the form data for users table
        $cleanUsername = $this->cleanUsername($this->request->getPost('username'));
        $dataForUsersTable = [
            'email' => $this->request->getPost('email'),
            'username' => $cleanUsername,
            'first_name' => $this->request->getPost('firstName'),
            'last_name' => $this->request->getPost('lastName'),
            'hash_pass' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'status' => 'inactive', // Set the initial status as "inactive"
            'token_register' => $verificationToken,
            'role' => 'default', // Set the default role
        ];

        // Insert data into users table
        $this->usersModel->insert($dataForUsersTable);

        // Get the last inserted ID, i.e., the user ID
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
