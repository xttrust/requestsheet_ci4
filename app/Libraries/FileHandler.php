<?php

namespace App\Libraries;

class FileHandler {

    public function __construct() {
        // Load any dependencies or configurations if needed
    }

    // array('jpg', 'jpeg', 'png', 'gif')
    // ROOTPATH . 'public' . DS . 'uploads' . DS . 'images' . DS . 'test' . DS
    // Returns $data as array with: error, name, thumb
    public function uploadAndResize($file, $path, $allowedTypes, $width = '500', $height = '300') {
        $image = \Config\Services::image();

        $originalName = strtolower($file->getName());
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $allowedExtensions = $allowedTypes;

        if (!in_array($extension, $allowedExtensions)) {
            $data['error'] = "Invalid file extension.";
            return $data;
        }

        $filenameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
        $newName = url_title($filenameWithoutExtension) . '.' . $extension;

        // Ensure the filename is unique
        $counter = 1;
        while (file_exists($path . $newName)) {
            $newName = url_title($filenameWithoutExtension) . '_' . $counter . '.' . $extension;
            $counter++;
        }

        // Move the uploaded file to the destination directory with the new name
        if (!$file->move($path, $newName)) {
            $data['error'] = "Error while trying to move the file.";
            return $data;
        }



        // Create a thumbnail
        $generateThumbnail = $image->withFile($path . $newName)->fit($width, $height, 'center')->save($path . 'thumb_' . $newName);

        if (!$generateThumbnail) {
            $data['error'] = "Error while generating the thumbnail.";
            return $data;
        }
        $data = [
            'error' => false,
            'name' => $newName,
            'thumb' => 'thumb_' . $newName
        ];
        return $data;
    }

    public function cleanFileName($fileName) {
        // Remove spaces and other special characters from the filename
        $cleanFileName = preg_replace("/[^A-Za-z0-9\-_.]/", '', $fileName);

        return $cleanFileName;
    }

    public function moveFile($sourceFilePath, $destinationPath) {
        if (file_exists($sourceFilePath) && is_file($sourceFilePath)) {
            return rename($sourceFilePath, $destinationPath);
        } else {
            return false;
        }
    }

    public function deleteFile($filePath) {
        if (file_exists($filePath) && is_file($filePath)) {
            unlink($filePath);
            return true;
        } else {
            return false;
        }
    }

    // Add more methods as needed...
}
