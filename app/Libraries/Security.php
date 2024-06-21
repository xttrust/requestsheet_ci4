<?php

namespace App\Libraries;

use App\Models\UsersModel;
use App\Models\UserRolesModel;
use App\Models\UserDetailsModel;

class Security {

    private $userModel;
    private $userRoleModel;
    public $userId;

    public function __construct() {
        $this->userModel = new UsersModel();
        $this->userRoleModel = new UserRolesModel();
        $this->userId = $this->getUserId();
    }

    public function getUserId() {
        return session('userId');
    }

    public function getLoggedInUser() {
        return $this->userModel->getById($this->userId);
    }

    public function getUserDetails() {
        $userDetailsModel = new UserDetailsModel();
        return $userDetailsModel->getByUserId($this->getUserId());
    }

    public function getUserRole($roleId) {
        return $this->userRoleModel->getById($roleId);
    }

    /**
     * @return type redirect
     * if ($this->security->authenticate() !== null) {
     *     return $this->security->authenticate();
     *  }
     */
    public function authenticate() {
        if (!$this->userId) {
            return redirect()->to('login')->with('fail', _messageLogin());
        }
        
    }

    

    /**
     * @return type redirect
     * if ($this->security->authorize('Admin') !== null) {
     *      return $this->security->authorize('Admin');
     *  }
     */
    public function authorize(string $requiredRole) {
        $loggedUser = $this->getLoggedInUser();

        $userRoleId = $loggedUser->role_id;
        $role = $this->userRoleModel->getById($userRoleId);

        if (!$role || $role->name !== $requiredRole) {
            return redirect()->to('account/profile/' . $loggedUser->username)->with('fail', _messageForbidden());
        }
        return null;
    }

    // Eexample of usage on how to check authenticate/authorize
    private function _example_check_security_auth() {
        // This will only authenticate the user or redirect to login
        if ($this->security->authenticate() !== null) {
            return $this->security->authenticate();
        }
        // This will authenticate the user and also check for the role or redirect
        if ($this->security->authorize('Admin') !== null) {
            return $this->security->authorize('Admin');
        }
    }

}
