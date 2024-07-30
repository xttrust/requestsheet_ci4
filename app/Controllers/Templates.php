<?php

namespace App\Controllers;

use App\Models\SettingsModel;

class Templates extends BaseController {

    protected $settingsModel;

    public function __construct() {
        $this->settingsModel = new SettingsModel(); // Initialize the settings model
    }

    public function backend($data) {
        $data['themeUrl'] = base_url('public/themes/backend/');

        // Fetch all settings from the database
        $settings = $this->settingsModel->findAll(); // Fetch settings from the model
        // Transform settings into an associative array for easy access
        $settingsArray = [];
        foreach ($settings as $setting) {
            $settingsArray[$setting['row']] = $setting['content'];
        }

        // Add settings to the data array
        $data['settings'] = $settingsArray;

        // Specify the full path to the view files in the public folder
        echo view('../../public/themes/backend/header', $data);
        echo view('../../public/themes/backend/sidebar', $data);
        echo view('../../public/themes/backend/' . $data['viewPath'], $data);
        echo view('../../public/themes/backend/footer', $data);
    }

    public function frontend($data) {
        $data['themeUrl'] = base_url('public/themes/frontend/');

        // Fetch all settings from the database
        $settings = $this->settingsModel->findAll(); // Fetch settings from the model
        // Transform settings into an associative array for easy access
        $settingsArray = [];
        foreach ($settings as $setting) {
            $settingsArray[$setting['row']] = $setting['content'];
        }

        // Add settings to the data array
        $data['settings'] = $settingsArray;

        // Specify the full path to the view files in the public folder
        echo view('../../public/themes/frontend/header', $data);
        echo view('../../public/themes/frontend/' . $data['viewPath'], $data);
        echo view('../../public/themes/frontend/footer', $data);
    }
}
