<?php

namespace App\Controllers;

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
        if (session()->has('userId')) {
            // Simulate retrieving user data
            // In a real application, you would fetch user details from the database
            $user = [
                'username' => $username,
                'message' => 'Login successful! Welcome back, ' . $username
            ];

            echo $user['username'];
        } else {
            // If not logged in, redirect to the login page with an error message
            return redirect()->to('login')->with('fail', 'You must be logged in to view this page');
        }
    }
}
