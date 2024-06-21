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
}
