<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use App\Models\UsersModel;

class ResetPassword extends BaseController {

    private $usersModel;

    public function __construct() {
        $this->usersModel = new UsersModel();
    }

    /**
     * Displays the form to request a password reset.
     */
    public function index() {
        // If the user is logged in, redirect to profile
        $loggedUser = $this->appSecurity->getLoggedInUser();
        if ($loggedUser) {
            return redirect()->to('profile/' . $loggedUser['username'] . '/?logged=true')
                            ->with('success', 'You are already logged in.');
        }

        // Render the password reset request form
        $data = [
            'pageTitle' => 'Reset your password | Requestsheet',
            'viewPath' => 'reset_password',
            'loggedUser' => $loggedUser
        ];

        return $this->templates->frontend($data);
    }

    /**
     * Handles the password reset request by generating a reset token and sending an email.
     */
    public function requestReset() {
        // Validate email input
        $email = $this->request->getPost('email');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('fail', 'Invalid email address.');
        }

        // Check if the email exists in the database
        $user = $this->usersModel->where('email', $email)->first();
        if (!$user) {
            return redirect()->back()->with('fail', 'Email not found.');
        }

        // Generate a password reset token
        $resetToken = bin2hex(random_bytes(32));
        $this->usersModel->update($user['id'], ['token_reset' => $resetToken]);

        // Send the password reset email
        $this->sendResetEmail($email, $resetToken);

        // Notify the user to check their email
        session()->setFlashdata('success', 'If the email exists in our system, a reset link has been sent to it.');
        return redirect()->to('reset-password');
    }

    /**
     * Displays the password reset form if the token is valid.
     */
    public function resetForm($token) {
        $user = $this->usersModel->where('token_reset', $token)->first();

        if (!$user) {
            return redirect()->to('reset-password')->with('fail', 'Invalid or expired token.');
        }

        // Render the password reset form
        $data = [
            'pageTitle' => 'Set a new password | Requestsheet',
            'viewPath' => 'reset_password_form',
            'token' => $token,
            'loggedUser' => $this->appSecurity->getLoggedInUser()
        ];

        return $this->templates->frontend($data);
    }

    /**
     * Handles the new password submission and updates it in the database.
     */
    public function updatePassword() {
        // Validate the input
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirmPassword');

        if ($password !== $confirmPassword) {
            return redirect()->back()->with('fail', 'Passwords do not match.');
        }

        $user = $this->usersModel->where('token_reset', $token)->first();
        if (!$user) {
            return redirect()->to('reset-password')->with('fail', 'Invalid or expired token.');
        }

        // Update the password
        $this->usersModel->update($user['id'], [
            'hash_pass' => password_hash($password, PASSWORD_DEFAULT),
            'token_reset' => null // Clear the reset token
        ]);

        // Notify the user
        session()->setFlashdata('success', 'Your password has been updated. You can now log in with your new password.');
        return redirect()->to('login');
    }

    /**
     * Send a password reset email to the user.
     *
     * @param string $email The user's email address
     * @param string $resetToken The password reset token
     */
    private function sendResetEmail($email, $resetToken) {
        $mail = new PHPMailer(true);

        try {
            // Configure SMTP settings
            $mail->isSMTP();
            $mail->Host = 'mail.creativeigniter.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'test@creativeigniter.com';
            $mail->Password = '6L]GPr.uZ(Gi';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->setFrom('test@creativeigniter.com', 'CreativeIgniter.com');
            $mail->addAddress($email);

            // Set email format and subject
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';

            // Generate the reset link
            $resetLink = base_url('reset-password/reset-form/') . $resetToken;

            // HTML and plain text versions of the email
            $htmlMessage = '<!doctype html><html><body>';
            $htmlMessage .= 'Hello, <br><br>';
            $htmlMessage .= 'You requested a password reset. Please click the following link to set a new password:<br>';
            $htmlMessage .= '<a href="' . $resetLink . '">' . $resetLink . '</a><br><br>';
            $htmlMessage .= 'If you did not request this, please ignore this email.<br><br>';
            $htmlMessage .= 'Best regards,<br>Requestsheet.com';
            $htmlMessage .= '</body></html>';

            $plainMessage = 'Hello, ';
            $plainMessage .= 'You requested a password reset. ';
            $plainMessage .= 'Please copy and paste the following link into your browser to set a new password: ';
            $plainMessage .= $resetLink;
            $plainMessage .= ' If you did not request this, please ignore this email.';

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
