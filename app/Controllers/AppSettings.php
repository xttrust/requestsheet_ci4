<?php

namespace App\Controllers;

use App\Models\SettingsModel;

class AppSettings extends BaseController {

    protected $settingsModel;

    public function __construct() {
        $this->settingsModel = new SettingsModel();
    }

    public function general() {
        $data = [
            'pageTitle' => 'Administration > Settings > General',
            'viewPath' => 'settings/general',
            'loggedUser' => $this->appSecurity->getLoggedInUser(),
        ];

        if ($this->request->getPost('submit') == "Submit") {
            // Retrieve form data
            $settings = [
                'website_name' => $this->request->getPost('website_name'),
                'currency_symbol' => $this->request->getPost('currency_symbol'),
                'currency_name' => $this->request->getPost('currency_name'),
                'home_seo_title' => $this->request->getPost('home_seo_title'),
                'home_seo_description' => $this->request->getPost('home_seo_description')
            ];

            // Update settings
            foreach ($settings as $key => $value) {
                $setting = $this->settingsModel->getSettingByRow($key);
                if ($setting) {
                    $this->settingsModel->updateSetting($setting['id'], ['content' => $value]);
                } else {
                    $this->settingsModel->addSetting(['row' => $key, 'content' => $value]);
                }
            }

            // Set a success message
            session()->setFlashdata('success', 'General settings updated successfully.');

            return redirect()->to(base_url('admin/settings/general'));
        }

        // Load current settings
        $data['website_name'] = $this->settingsModel->getSettingByRow('website_name')['content'] ?? '';
        $data['currency_symbol'] = $this->settingsModel->getSettingByRow('currency_symbol')['content'] ?? '';
        $data['currency_name'] = $this->settingsModel->getSettingByRow('currency_name')['content'] ?? '';
        $data['home_seo_title'] = $this->settingsModel->getSettingByRow('home_seo_title')['content'] ?? '';
        $data['home_seo_description'] = $this->settingsModel->getSettingByRow('home_seo_description')['content'] ?? '';

        return $this->templates->backend($data);
    }

    public function email() {
        $data = [
            'pageTitle' => 'Administration > Settings > Email',
            'viewPath' => 'settings/email',
            'loggedUser' => $this->appSecurity->getLoggedInUser(),
        ];

        if ($this->request->getPost('submit') == "Submit") {
            // Retrieve form data
            $emailSettings = [
                'smtp_host' => $this->request->getPost('smtp_host'),
                'smtp_user' => $this->request->getPost('smtp_user'),
                'smtp_password' => $this->request->getPost('smtp_password'),
                'smtp_secure' => $this->request->getPost('smtp_secure'),
                'smtp_port' => $this->request->getPost('smtp_port'),
                'admin_email' => $this->request->getPost('admin_email'),
                'support_email' => $this->request->getPost('support_email'),
                'office_email' => $this->request->getPost('office_email')
            ];

            // Update settings
            foreach ($emailSettings as $key => $value) {
                $setting = $this->settingsModel->getSettingByRow($key);
                if ($setting) {
                    $this->settingsModel->updateSetting($setting['id'], ['content' => $value]);
                } else {
                    $this->settingsModel->addSetting(['row' => $key, 'content' => $value]);
                }
            }

            // Set a success message
            session()->setFlashdata('success', 'Email settings updated successfully.');

            return redirect()->to(base_url('admin/settings/email'));
        }

        // Load current settings
        $data['smtp_host'] = $this->settingsModel->getSettingByRow('smtp_host')['content'] ?? '';
        $data['smtp_user'] = $this->settingsModel->getSettingByRow('smtp_user')['content'] ?? '';
        $data['smtp_password'] = $this->settingsModel->getSettingByRow('smtp_password')['content'] ?? '';
        $data['smtp_secure'] = $this->settingsModel->getSettingByRow('smtp_secure')['content'] ?? '';
        $data['smtp_port'] = $this->settingsModel->getSettingByRow('smtp_port')['content'] ?? '';
        $data['admin_email'] = $this->settingsModel->getSettingByRow('admin_email')['content'] ?? '';
        $data['support_email'] = $this->settingsModel->getSettingByRow('support_email')['content'] ?? '';
        $data['office_email'] = $this->settingsModel->getSettingByRow('office_email')['content'] ?? '';

        return $this->templates->backend($data);
    }

    public function security() {
        $data = [
            'pageTitle' => 'Administration > Settings > Security',
            'viewPath' => 'settings/security',
            'loggedUser' => $this->appSecurity->getLoggedInUser()
        ];

        return $this->templates->backend($data);
    }

    public function layout() {
        $data = [
            'pageTitle' => 'Administration > Settings > Layout',
            'viewPath' => 'settings/layout',
            'loggedUser' => $this->appSecurity->getLoggedInUser()
        ];

        return $this->templates->backend($data);
    }

    public function uploadLogo() {
        if ($this->request->getPost('submit') == "Upload Logo") {
            $file = $this->request->getFile('logo');

            if ($file->isValid() && !$file->hasMoved()) {
                $uploadPath = ROOTPATH . 'public/uploads/images/';
                $fileName = 'logo.png'; // Fixed filename for the logo
                // Delete existing logo file if it exists
                if (file_exists($uploadPath . $fileName)) {
                    unlink($uploadPath . $fileName);
                }

                // Move the new file to the uploads folder
                $file->move($uploadPath, $fileName);

                // Get the row from the database
                $dbLogoRow = $this->settingsModel->getSettingByRow('logo');

                if ($dbLogoRow) {
                    // Update the path in the database using the row id
                    $this->settingsModel->updateSetting($dbLogoRow['id'], ['row' => 'logo', 'content' => $fileName]);
                } else {
                    // Handle the case where the setting does not exist
                    $this->settingsModel->insertSetting(['row' => 'logo', 'content' => $fileName]);
                }

                // Set success message
                session()->setFlashdata('success', 'Logo uploaded successfully.');
            } else {
                // Set error message
                session()->setFlashdata('error', 'Failed to upload logo.');
            }
        }

        return redirect()->to(base_url('admin/settings/layout'));
    }

    public function uploadFavicon() {
        if ($this->request->getPost('submit') == "Upload Favicon") {
            $file = $this->request->getFile('favicon');

            if ($file->isValid() && !$file->hasMoved()) {
                $uploadPath = ROOTPATH . 'public/uploads/images/';
                $fileName = 'favicon.ico'; // Fixed filename for the favicon
                // Delete existing favicon file if it exists
                if (file_exists($uploadPath . $fileName)) {
                    unlink($uploadPath . $fileName);
                }

                // Move the new file to the uploads folder
                $file->move($uploadPath, $fileName);

                // Get the row from the database
                $dbFaviconRow = $this->settingsModel->getSettingByRow('favicon');

                if ($dbFaviconRow) {
                    // Update the path in the database using the row id
                    $this->settingsModel->updateSetting($dbFaviconRow['id'], ['row' => 'favicon', 'content' => $fileName]);
                } else {
                    // Handle the case where the setting does not exist
                    $this->settingsModel->insertSetting(['row' => 'favicon', 'content' => $fileName]);
                }

                // Set success message
                session()->setFlashdata('success', 'Favicon uploaded successfully.');
            } else {
                // Set error message
                session()->setFlashdata('error', 'Failed to upload favicon.');
            }
        }

        return redirect()->to(base_url('admin/settings/layout'));
    }
}
