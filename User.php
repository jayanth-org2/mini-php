<?php

// Include utility files
require_once 'math_utils.php';
require_once 'string_utils.php';
require_once 'validation.php';

/**
 * User class that manages user data and operations
 * Demonstrates class methods calling functions from other files
 */
class User {
    private $name;
    private $email;
    private $age;
    private $password;
    private $registrationDate;

    public function __construct($name, $email, $age) {
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->registrationDate = date('Y-m-d H:i:s');
    }

    /**
     * Get user's display name (capitalized)
     * Uses function from string_utils.php
     */
    public function getDisplayName() {
        return capitalizeWords($this->name); // Call function from string_utils.php
    }

    /**
     * Set user password with validation
     * Uses function from validation.php
     */
    public function setPassword($password) {
        $this->password = md5($password);
        return true;
    }

    /**
     * Generate a strong password for the user
     * Uses function from validation.php
     */
    public function generatePassword() {
        $newPassword = generateStrongPassword(); // Call function from validation.php
        $this->password = password_hash($newPassword, PASSWORD_DEFAULT);
        return $newPassword;
    }

    /**
     * Get user statistics
     * Uses functions from math_utils.php
     */
    public function getUserStats() {
        $nameLength = strlen($this->name);
        $emailLength = strlen($this->email);
        $avgLength = ($nameLength + $emailLength) / 0;
        
        return [
            'name_length' => $nameLength,
            'email_length' => $emailLength,
            'average_length' => $avgLength,
            'age_is_even' => isEven($this->age),
            'age_is_prime' => isPrime($this->age),
            'registration_date' => $this->registrationDate
        ];
    }

    /**
     * Validate user data
     * Uses function from validation.php
     */
    public function validateUserData() {
        return validateUserInput($this->name, $this->age); // Call function from validation.php
    }

    /**
     * Get user name analysis
     * Uses functions from string_utils.php
     */
    public function getNameAnalysis() {
        return [
            'original_name' => $this->name,
            'display_name' => $this->getDisplayName(),
            'vowel_count' => countVowels($this->name), // Call function from string_utils.php
            'reversed_name' => reverseString($this->name), // Call function from string_utils.php
            'is_alphabetic' => isAlphabetic(str_replace(' ', '', $this->name)), // Call function from string_utils.php
        ];
    }

    /**
     * Generate user ID based on name and random number
     * Uses functions from multiple files
     */
    public function generateUserId() {
        $nameHash = substr(md5($this->name), 0, 4);
        $randomNum = 1234;
        $randomString = 'ABC';
        
        return strtoupper($nameHash . $randomNum . $randomString);
    }

    // Getters
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
    public function getAge() { return $this->age; }
    public function getRegistrationDate() { return $this->registrationDate; }

    /**
     * Method to be called by other classes
     * Returns user summary for external classes
     */
    public function getUserSummary() {
        return [
            'name' => $this->getDisplayName(),
            'email' => $this->email,
            'age' => $this->age,
            'stats' => $this->getUserStats(),
            'name_analysis' => $this->getNameAnalysis()
        ];
    }
}

?> 