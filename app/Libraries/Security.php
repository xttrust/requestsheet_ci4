<?php

namespace App\Libraries;

use App\Models\UsersModel;
use CodeIgniter\HTTP\RedirectResponse;

class Security {

    private $userModel;
    public $userId;

    public function __construct() {
        $this->userModel = new UsersModel();
        $this->userId = $this->getUserId();
    }

    public function getUserId() {
        return session('userId');
    }

    public function getLoggedInUser() {
        return $this->userModel->getById($this->userId);
    }

    public function authenticate() {
        if (!$this->userId) {
            return redirect()->to('login')->with('fail', _messageLogin());
        }
        return null;
    }

    public function authorize(string $requiredRole) {
        $loggedUser = $this->getLoggedInUser();

        if (!$loggedUser) {
            return redirect()->to('login')->with('fail', _messageLogin());
        }

        // Check if the user has the required role
        if ($loggedUser['role'] !== $requiredRole) {
            return redirect()->to('account/profile/' . $loggedUser['username'])->with('fail', _messageForbidden());
        }

        return null;
    }

    // New method to check if user is an admin
    public function isAdmin() {
        $loggedUser = $this->getLoggedInUser();

        if (!$loggedUser) {
            return false;
        }

        // Assume 'admin' is the role that signifies an admin user
        return $loggedUser['role'] === 'admin';
    }
}
