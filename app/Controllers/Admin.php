<?php

namespace App\Controllers;

class Admin extends BaseController {

    public function dashboard() {
        $data = [
            'pageTitle' => 'Administration > Dashboard',
            'viewPath' => 'index',
            'loggedUser' => $this->appSecurity->getLoggedInUser()
        ];

        return $this->templates->backend($data);
    }
}
