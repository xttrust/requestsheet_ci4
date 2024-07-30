<?php

namespace App\Libraries;

use CodeIgniter\HTTP\Exceptions\HTTPException;
use CodeIgniter\Files\Exceptions\FileException;

class FileUploader {

    protected $allowedTypes = [];
    protected $maxSize = 0;
    protected $uploadPath = 'uploads/';

    public function __construct(array $config = []) {
        // Set config values if provided
        if (isset($config['allowedTypes'])) {
            $this->allowedTypes = $config['allowedTypes'];
        }
        if (isset($config['maxSize'])) {
            $this->maxSize = $config['maxSize'];
        }
        if (isset($config['uploadPath'])) {
            $this->uploadPath = rtrim($config['uploadPath'], '/') . '/';
        }
    }

    /**
     * Handle file upload.
     *
     * @param \CodeIgniter\HTTP\IncomingRequest $request
     * @param string $inputName
     * @return array
     * @throws \CodeIgniter\HTTP\Exceptions\HTTPException
     */
    public function upload($request, $inputName) {
        $file = $request->getFile($inputName);

        if (!$file->isValid()) {
            throw new HTTPException('Invalid file upload.');
        }

        // Validate file type and size
        if (!$this->isAllowedType($file->getClientMimeType()) || !$this->isAllowedSize($file->getSize())) {
            throw new HTTPException('File type or size not allowed.');
        }

        // Create upload path if not exists
        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }

        // Generate new file name
        $newName = $file->getRandomName();

        // Move file to upload path
        if ($file->move($this->uploadPath, $newName)) {
            return ['success' => true, 'fileName' => $newName, 'filePath' => $this->uploadPath . $newName];
        } else {
            throw new FileException('Failed to move uploaded file.');
        }
    }

    /**
     * Handle multiple file uploads.
     *
     * @param \CodeIgniter\HTTP\IncomingRequest $request
     * @param string $inputName
     * @return array
     * @throws \CodeIgniter\HTTP\Exceptions\HTTPException
     */
    public function uploadMultiple($request, $inputName) {
        $files = $request->getFiles();
        $uploadedFiles = [];

        foreach ($files[$inputName] as $file) {
            if (!$file->isValid()) {
                throw new HTTPException('Invalid file upload.');
            }

            if (!$this->isAllowedType($file->getClientMimeType()) || !$this->isAllowedSize($file->getSize())) {
                throw new HTTPException('File type or size not allowed.');
            }

            if (!is_dir($this->uploadPath)) {
                mkdir($this->uploadPath, 0755, true);
            }

            $newName = $file->getRandomName();

            if ($file->move($this->uploadPath, $newName)) {
                $uploadedFiles[] = ['success' => true, 'fileName' => $newName, 'filePath' => $this->uploadPath . $newName];
            } else {
                $uploadedFiles[] = ['success' => false, 'fileName' => $file->getName()];
            }
        }

        return $uploadedFiles;
    }

    /**
     * Check if the file type is allowed.
     *
     * @param string $mimeType
     * @return bool
     */
    protected function isAllowedType($mimeType) {
        return in_array($mimeType, $this->allowedTypes);
    }

    /**
     * Check if the file size is allowed.
     *
     * @param int $size
     * @return bool
     */
    protected function isAllowedSize($size) {
        return $size <= $this->maxSize;
    }
}
