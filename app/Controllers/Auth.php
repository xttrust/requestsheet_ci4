<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Libraries\Security;
use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController {

    private $usersModel;
    private $security;

    public function __construct() {
        $this->usersModel = new UsersModel();
        $this->security = new Security();
    }

    /**
     * Displays the login page if the user is not already logged in.
     * Redirects to the account page if the user is logged in.
     */
    public function index() {
        if ($this->security->getUserId()) {
            return redirect()->to('account?logged=true')->with('success', 'You are already logged in.');
        }
        return "Login view to follow";
    }

    /**
     * Handles the login process, including user authentication and session management.
     */
    public function login() {
        // Get the posted data
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $rememberMe = $this->request->getPost('rememberMe');

        // Get the user from the database
        $user = $this->usersModel->getBy('username', $username);

        // Check if the user exists and the password is correct
        if ($user && password_verify($password, $user['hash_pass'])) {
            // Authentication successful
            // Store user information in session
            session()->set('userId', $user['id']);

            // Set remember me cookie if requested
            if ($rememberMe) {
                $this->setRememberMeCookie($user['id']);
            }

            // Redirect to the authenticated user's profile page
            return redirect()->to('account/profile/' . $user['username'])->with('success', 'Welcome back ' . $user['username']);
        } else {
            // Authentication failed
            // Redirect back to the login page with an error message
            return redirect()->to('login')->with('fail', 'Invalid username or password');
        }
    }

    /**
     * Sets a remember me cookie with the user ID.
     *
     * @param int $userId The ID of the user to set the cookie for.
     */
    private function setRememberMeCookie(int $userId) {
        helper('text');
        $cookieName = 'rememberMe';
        $cookieValue = random_string('alnum', 64); // Generate a more secure random string
        $expiration = time() + (30 * 24 * 60 * 60); // 30 days
        setcookie($cookieName, $cookieValue, $expiration, '/');
    }

    /**
     * Logs out the user by clearing the session and the remember me cookie.
     */
    public function logout() {
        // Clear the user session
        session()->remove('userId');

        // Clear the remember me cookie
        $this->clearRememberMeCookie();

        // Redirect to the login page with a success message
        return redirect()->to('login')->with('success', 'You have been logged out.');
    }

    /**
     * Clears the remember me cookie by setting an expired value.
     */
    private function clearRememberMeCookie() {
        $cookieName = 'rememberMe';
        $expiration = time() - 3600; // Set the expiration time in the past
        setcookie($cookieName, '', $expiration, '/');

        // Unset the $_COOKIE superglobal to reflect the change immediately
        if (isset($_COOKIE[$cookieName])) {
            unset($_COOKIE[$cookieName]);
        }
    }

    /**
     * Activates a user account based on the provided activation token.
     *
     * @param string $token The activation token.
     */
    public function activateAccount(string $token) {
        // Find the user with the given activation token
        $user = $this->usersModel->where('verification_token', $token)->first();

        if ($user) {
            // Activate the user's account
            $user['status'] = 'active';
            $user['verification_token'] = null;
            $this->usersModel->update($user['id'], $user);

            // Redirect to the login page with a success message
            return redirect()->to('login')->with('success', 'Your account has been activated. Please log in.');
        } else {
            // Redirect to the register page with an error message
            return redirect()->to('register')->with('fail', 'Your account is already activated or the token is invalid.');
        }
    }
}
