<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Auth extends BaseController {

    private $usersModel;

    public function __construct() {
        $this->usersModel = new UsersModel();
    }

    /**
     * Displays the login page if the user is not already logged in.
     * Redirects to the account page if the user is logged in.
     */
    public function index() {
        if ($this->appSecurity->getUserId()) {
            // Get the logged-in user's data
            $loggedInUser = $this->appSecurity->getLoggedInUser();

            // Redirect to the user's profile page with a success message
            return redirect()->to('profile/' . $loggedInUser['username'] . '/?logged=true')->with('success', 'You are already logged in.');
        }

        // Data for rendering the login page
        $data = [
            'pageTitle' => 'Login | Requestsheet',
            'viewPath' => 'login'
        ];

        // Render the login page
        return $this->templates->frontend($data);
    }

    /**
     * Handles the login process, including user authentication and session management.
     */
    public function login() {
        // Validate inputs
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|alpha_numeric|min_length[3]',
            'password' => 'required|min_length[8]',
            'rememberMe' => 'permit_empty'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('login')->with('fail', $validation->listErrors());
        }

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
            session()->set('userRole', $user['role']);

            // Set remember me cookie if requested
            if ($rememberMe) {
                $this->setRememberMeCookie($user['id']);
            }

            // Redirect to the authenticated user's profile page
            return redirect()->to('profile/' . $user['username'])->with('success', 'Welcome back ' . $user['username']);
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
        // Store the remember me token in the database
        //$this->usersModel->update($userId, ['remember_token' => $cookieValue]);
        // Set the cookie
        $this->response->setCookie($cookieName, $cookieValue, $expiration, '', '/', '', true, true); // HttpOnly and Secure flags
    }

    /**
     * Logs out the user by clearing the session and the remember me cookie.
     */
    public function logout() {
        // Clear the user session
        session()->remove(['userId', 'userRole']);

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

        // Remove the remember me token from the database
        $userId = session()->get('userId');
        if ($userId) {
            $this->usersModel->update($userId, ['remember_token' => null]);
        }

        // Unset the cookie by setting an expiration date in the past
        $this->response->deleteCookie($cookieName, '', '/');
    }

    /**
     * Activates a user account based on the provided activation token.
     *
     * @param string $token The activation token.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function activateAccount(string $token) {
        // Find the user with the given activation token
        $user = $this->usersModel->where('token_register', $token)
                ->where('status', 'inactive') // Ensure token is for an inactive account
                ->first();

        if ($user) {
            // Check token expiry (if implemented)
            // Example: if ($user['token_expiry'] < time()) { ... }
            // Activate the user's account
            $userData = [
                'status' => 'active',
                'token_register' => null, // Remove the token
                    // Optionally: 'token_expiry' => null // Remove expiry if applicable
            ];
            $this->usersModel->update($user['id'], $userData);

            // Redirect to the login page with a success message
            return redirect()->to('login')->with('success', 'Your account has been activated. Please log in.');
        } else {
            // Redirect to the register page with an error message
            return redirect()->to('register')->with('fail', 'Invalid activation token or your account is already activated.');
        }
    }
}
