<?php

class FileHandler {
    private $uploadPath;
    private $allowedExtensions;
    private $maxFileSize;

    public function __construct($uploadPath = null, $allowedExtensions = [], $maxFileSize = 5242880) {
        $this->uploadPath = $uploadPath ?? UPLOAD_PATH;
        $this->allowedExtensions = $allowedExtensions;
        $this->maxFileSize = $maxFileSize; // Default 5MB
    }

    public function upload($file, $customName = null) {
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            throw new Exception('Invalid file upload');
        }

        $fileName = $customName ?? $this->generateUniqueName($file['name']);
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // Validate file
        $this->validateFile($file, $fileExtension);

        // Create upload directory if it doesn't exist
        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }

        $destination = $this->uploadPath . '/' . $fileName;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return [
                'success' => true,
                'filename' => $fileName,
                'path' => $destination
            ];
        }

        throw new Exception('Failed to move uploaded file');
    }

    public function delete($filename) {
        $filePath = $this->uploadPath . '/' . $filename;
        if (file_exists($filePath) && is_file($filePath)) {
            return unlink($filePath);
        }
        return false;
    }

    public function read($filename) {
        $filePath = $this->uploadPath . '/' . $filename;
        if (file_exists($filePath) && is_file($filePath)) {
            return file_get_contents($filePath);
        }
        return false;
    }

    private function validateFile($file, $extension) {
        // Check file size
        if ($file['size'] > $this->maxFileSize) {
            throw new Exception('File size exceeds limit');
        }

        // Check file extension
        if (!empty($this->allowedExtensions) && !in_array($extension, $this->allowedExtensions)) {
            throw new Exception('File type not allowed');
        }

        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('File upload error: ' . $file['error']);
        }
    }

    private function generateUniqueName($originalName) {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        return uniqid() . '_' . time() . '.' . $extension;
    }
} 