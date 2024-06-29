<?php

namespace App\Controllers;

class Admin extends BaseController {

    public function index() {
        $data = [
            'pageTitle' => 'Administration > Index',
            'viewPath' => 'index'
        ];
        return $this->templates->backend($data);
    }
}
