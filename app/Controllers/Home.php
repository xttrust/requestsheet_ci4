<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Home extends BaseController {

    public function index() {
        $data = [
            'pageTitle' => 'Requestsheet new website',
            'viewPath' => 'index',
            'loggedUser' => $this->appSecurity->getLoggedInUser()
        ];
        return $this->templates->frontend($data);
    }

    public function profile($username) {
        $data = [
            'pageTitle' => 'User Profile: ' . $username . ' | Requestsheet',
            'viewPath' => 'profile',
            'loggedUser' => $this->appSecurity->getLoggedInUser()
        ];
        return $this->templates->frontend($data);
    }

    public function test() {
        $userInput = "1super999"; // User-provided plain text password

        $hashedPass = '$2y$10$J0F9cuYqD71kMPnHWiyhAefcP1phWCGWdMRNToRwFFhryBB9XgqDm'; // Hashed password from your database

        if (password_verify($userInput, $hashedPass)) {
            echo "Matches";
        } else {
            echo "Doesn't Match";
        }
    }
}
