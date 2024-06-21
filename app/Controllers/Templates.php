<?php

namespace App\Controllers;

class Templates extends BaseController {

    public function __construct() {

    }

    public function backend($data) {
        $data['themeUrl'] = base_url('public/themes/backend/');

        // Specify the full path to the view files in the public folder
        echo view('../../public/themes/backend/header', $data);
        echo view('../../public/themes/backend/sidebar', $data);
        echo view('../../public/themes/backend/' . $data['viewPath']);
        echo view('../../public/themes/backend/footer');
    }

    public function frontend($data) {
        $data['themeUrl'] = base_url('public/themes/frontend/');

        echo view('public/themes/frontend/header', $data);
        echo view($data['viewPath']);
        echo view('public/themes/frontend/footer');
    }
}
