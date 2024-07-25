<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Libraries\AppSecurity;

class Auth implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null) {
        // Check if the user is logged in
        $session = session();
        $userId = $session->get('userId');
        $appSecurity = new AppSecurity();
        $loggedUser = $appSecurity->getLoggedInUser();

        if (!$userId) {
            // Redirect to login if not authenticated
            return redirect()->to('login')->with('fail', 'Please log in first.');
        }

        // Check for additional role-based access
        $role = $session->get('userRole'); // Assuming role is stored in session

        if ($arguments && $role !== $arguments[0]) {
            // Redirect if the user does not have the required role
            return redirect()->to('profile/' . $loggedUser['username'])->with('fail', 'Restricted access!');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // No action needed after the request
    }
}
