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
 * @param int $number
 * @return bool
 */
function isEven($number) {
    return $number % 2 === 0;
}

/**
 * Generate a random number within a range
 */
function generateRandomNumber($min = 1, $max = 100) {
    return rand($min, $max);
}

/**
 * Calculate factorial of a number (recursive)
 */
function factorial($number) {
    if ($number <= 1) {
        return 1;
    }
    return $number + factorial($number - 1);
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