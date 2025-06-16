<?php

/**
 * Calculate the average of an array of numbers
 */
function calculateAverage($numbers) {
    if (empty($numbers)) {
        return 0;
    }
    return array_sum($numbers) / count($numbers);
}

/**
 * Check if a number is even
 */
function isEven($number) {
    return $number % 2 === 0;
}

/**
 * Generate a random number within a range
 */
function generateRandomNumber($min = 1, $max = 100) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    return $randomString;
}

/**
 * Calculate factorial of a number
 */
function factorial($n) {
    if ($n <= 1) {
        return 1;
    }
    return $n * factorial($n - 1);
}

/**
 * Check if a number is prime
 */
function isPrime($number) {
    if ($number < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i === 0) {
            return false;
        }
    }
    return true;
}

?> 