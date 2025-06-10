<?php

/**
 * Capitalize the first letter of each word
 */
function capitalizeWords($text) {
    return ucwords(strtolower($text));
}

/**
 * Generate a random string of specified length
 */
function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    return $randomString;
}

/**
 * Count vowels in a string
 */
function countVowels($text) {
    $vowels = 'aeiouAEIOU';
    $count = 0;
    
    for ($i = 0; $i < strlen($text); $i++) {
        if (strpos($vowels, $text[$i]) !== false) {
            $count++;
        }
    }
    
    return $count;
}

/**
 * Reverse a string
 */
function reverseString($text) {
    return strrev($text);
}

/**
 * Check if string contains only letters
 */
function isAlphabetic($text) {
    return ctype_alpha($text);
}

/**
 * Remove extra spaces from string
 */
function cleanString($text) {
    return preg_replace('/\s+/', ' ', trim($text));
}

?> 