<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\RequestsModel;
use App\Models\AnnouncementsModel;

class Profile extends BaseController {

    private $usersModel;
    private $requestsModel;
    private $annModel;

    public function __construct() {
        $this->usersModel = new UsersModel();
        $this->requestsModel = new RequestsModel();
        $this->annModel = new AnnouncementsModel();
    }

    public function user($username) {
        // Sanitize and validate the username input
        $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($username)) {
            // Handle the error appropriately if the username is invalid
            return $this->response->setStatusCode(400)->setBody('Invalid username');
        }

        // Fetch the user by username
        $user = $this->usersModel->getBy('username', $username);
        if (!$user) {
            // Handle the error appropriately if the user is not found
            return $this->response->setStatusCode(404)->setBody('User not found');
        }

        // Fetch the user's announcements safely
        $announcements = $this->annModel->getAllByUserId($user['id']);
        if ($announcements === false) {
            // Handle the error appropriately if announcements fetching fails
            return $this->response->setStatusCode(500)->setBody('Error fetching announcements');
        }

        // Prepare the data for the view
        $data = [
            'pageTitle' => 'User Profile: ' . htmlspecialchars($username, ENT_QUOTES, 'UTF-8') . ' | Requestsheet',
            'viewPath' => 'profile',
            'loggedUser' => $this->appSecurity->getLoggedInUser(),
            'announcements' => $announcements,
            'user' => $user
        ];

        // Render the view
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
