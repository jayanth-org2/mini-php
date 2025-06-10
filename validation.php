<?php

// Include the utility files
require_once 'math_utils.php';
require_once 'string_utils.php';

/**
 * Validate a password based on multiple criteria
 * Uses functions from both math_utils.php and string_utils.php
 */
function validatePassword($password) {
    $errors = [];
    
    // Check minimum length
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    
    // Check if it contains vowels (using string_utils function)
    $vowelCount = countVowels($password);
    if ($vowelCount < 2) {
        $errors[] = "Password must contain at least 2 vowels";
    }
    
    // Check if it's not purely alphabetic (using string_utils function)
    if (isAlphabetic($password)) {
        $errors[] = "Password must contain numbers or special characters";
    }
    
    return empty($errors) ? true : $errors;
}

/**
 * Generate a strong password using utility functions
 * Uses functions from both utility files
 */
function generateStrongPassword() {
    $length = generateRandomNumber(12, 16); // Use math_utils function
    $basePassword = generateRandomString($length); // Use string_utils function
    
    // Ensure it has at least one number
    $randomNumber = generateRandomNumber(1, 9); // Use math_utils function
    $basePassword .= $randomNumber;
    
    return $basePassword;
}

/**
 * Validate user input data
 * Uses functions from string_utils.php
 */
function validateUserInput($name, $age) {
    $errors = [];
    
    // Clean and validate name
    $cleanName = cleanString($name); // Use string_utils function
    if (empty($cleanName)) {
        $errors[] = "Name is required";
    } elseif (!isAlphabetic(str_replace(' ', '', $cleanName))) { // Use string_utils function
        $errors[] = "Name must contain only letters and spaces";
    }
    
    // Validate age using math functions
    if (!is_numeric($age) || $age < 1) {
        $errors[] = "Age must be a positive number";
    } elseif (isEven($age)) { // Use math_utils function
        // Just for demonstration - checking if age is even
        $message = "Age $age is even";
    }
    
    return [
        'valid' => empty($errors),
        'errors' => $errors,
        'clean_name' => $cleanName ?? '',
        'is_prime_age' => isPrime($age) // Use math_utils function
    ];
}

/**
 * Generate statistics about a text
 * Uses functions from both utility files
 */
function generateTextStats($text) {
    $cleanText = cleanString($text); // Use string_utils function
    $vowelCount = countVowels($cleanText); // Use string_utils function
    $words = explode(' ', $cleanText);
    $wordLengths = array_map('strlen', $words);
    $averageWordLength = calculateAverage($wordLengths); // Use math_utils function
    
    return [
        'original_text' => $text,
        'clean_text' => $cleanText,
        'vowel_count' => $vowelCount,
        'word_count' => count($words),
        'average_word_length' => round($averageWordLength, 2),
        'reversed_text' => reverseString($cleanText) // Use string_utils function
    ];
}

?> 