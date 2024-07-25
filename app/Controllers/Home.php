<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Home extends BaseController {

    public function index() {
        $data = [
            'pageTitle' => 'Requestsheet new website',
            'viewPath' => 'index'
        ];
        return $this->templates->frontend($data);
    }

    public function loggedin() {
        $data = [
            'pageTitle' => 'Logged In | Requestsheet',
            'viewPath' => 'loggedin'
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

    public function profile($username) {
        // Check if the user is logged in
        if (!$this->appSecurity->getUserId()) {
            // If not logged in, redirect to the login page with an error message
            return redirect()->to('login')->with('fail', 'You must be logged in to view this page');
        }

        // Fetch the user profile data by username
        $userModel = new UsersModel();
        $profileUser = $userModel->where('username', $username)->first();

        // Check if the user profile exists
        if (!$profileUser) {
            // Show the 404 error page
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Fetch the logged-in user data
        $loggedInUser = $this->appSecurity->getLoggedInUser();

        // Optionally, you can add additional authorization logic here
        // For example, if you only want users to view their own profiles
        if ($loggedInUser['id'] !== $profileUser['id']) {
            return redirect()->to('account')->with('fail', 'You are not authorized to view this profile.');
        }

        // Pass the profile data to the view
        $data = [
            'pageTitle' => "Profile of {$profileUser['username']}",
            'profileUser' => $profileUser,
            'loggedInUser' => $loggedInUser,
            'viewPath' => 'profile'
        ];

        return $this->templates->frontend($data);
    }
}
