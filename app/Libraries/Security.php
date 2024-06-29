<?php

namespace App\Libraries;

use App\Models\UsersModel;
use CodeIgniter\HTTP\RedirectResponse;

class Security {

    private $userModel;
    public $userId;

    /**
     * Security constructor.
     * Initializes the UsersModel and retrieves the user ID from the session.
     */
    public function __construct() {
        $this->userModel = new UsersModel();
        $this->userId = $this->getUserId();
    }

    /**
     * Retrieves the user ID from the session.
     *
     * @return mixed The user ID from the session.
     */
    public function getUserId() {
        return session('userId');
    }

    /**
     * Retrieves the logged-in user's details.
     *
     * @return array|null The user's details or null if not found.
     */
    public function getLoggedInUser() {
        return $this->userModel->getById($this->userId);
    }

    /**
     * Authenticates the user by checking if the user ID is set in the session.
     *
     * @return RedirectResponse|null Redirects to the login page if not authenticated.
     */
    public function authenticate() {
        if (!$this->userId) {
            return redirect()->to('login')->with('fail', _messageLogin());
        }
        return null;
    }

    /**
     * Authorizes the user by checking if the user has the required role.
     *
     * @param string $requiredRole The role required to access the resource.
     * @return RedirectResponse|null Redirects to the profile page if not authorized.
     */
    public function authorize(string $requiredRole) {
        $loggedUser = $this->getLoggedInUser();

        if (!$loggedUser) {
            return redirect()->to('login')->with('fail', _messageLogin());
        }

        if ($loggedUser['role'] !== $requiredRole) {
            return redirect()->to('account/profile/' . $loggedUser['username'])->with('fail', _messageForbidden());
        }
        return null;
    }
}
