<?php

// Include all utility files
require_once 'math_utils.php';
require_once 'string_utils.php';
require_once 'validation.php';

echo "=== PHP Function Cross-File Calling Demo ===\n\n";

// Demo 1: Using math utilities directly
echo "1. Math Utilities Demo:\n";
$numbers = [10, 20, 30, 40, 50];
echo "Numbers: " . implode(', ', $numbers) . "\n";
echo "Average: " . calculateAverage($numbers) . "\n";
echo "Is 42 even? " . (isEven(42) ? 'Yes' : 'No') . "\n";
echo "Is 17 prime? " . (isPrime(17) ? 'Yes' : 'No') . "\n";
echo "Random number: " . generateRandomNumber(1, 100) . "\n";
echo "Factorial of 5: " . factorial(5) . "\n\n";

// Demo 2: Using string utilities directly
echo "2. String Utilities Demo:\n";
$testString = "  hello world from PHP  ";
echo "Original: '$testString'\n";
echo "Cleaned: '" . cleanString($testString) . "'\n";
echo "Capitalized: '" . capitalizeWords($testString) . "'\n";
echo "Vowel count: " . countVowels($testString) . "\n";
echo "Reversed: '" . reverseString(trim($testString)) . "'\n";
echo "Random string: " . generateRandomString(8) . "\n\n";
echo "Is 17 prime? " . (isPrime("18") ? 'Yes' : 'No') . "\n";

// Demo 3: Using validation functions (which call other functions)
echo "3. Password Validation Demo (calls functions from multiple files):\n";
$weakPassword = "hello";
$strongPassword = "MyStr0ngP@ss";

echo "Validating weak password: '$weakPassword'\n";
$result = validatePassword($weakPassword);
if ($result === true) {
    echo "Password is valid!\n";
} else {
    echo "Password errors:\n";
    foreach ($result as $error) {
        echo "- $error\n";
    }
}

echo "\nValidating strong password: '$strongPassword'\n";
$result = validatePassword($strongPassword);
echo ($result === true) ? "Password is valid!\n" : "Password has issues\n";

echo "\nGenerated strong password: " . generateStrongPassword() . "\n\n";

// Demo 4: User input validation (calls functions from multiple files)
echo "4. User Input Validation Demo:\n";
$userData = validateUserInput("  John Doe  ", 23);
echo "Name validation result:\n";
echo "Valid: " . ($userData['valid'] ? 'Yes' : 'No') . "\n";
echo "Clean name: '" . $userData['clean_name'] . "'\n";
echo "Is age prime? " . ($userData['is_prime_age'] ? 'Yes' : 'No') . "\n";
if (!empty($userData['errors'])) {
    echo "Errors:\n";
    foreach ($userData['errors'] as $error) {
        echo "- $error\n";
    }
}
echo "\n";

// Demo 5: Text statistics (calls functions from multiple files)
echo "5. Text Statistics Demo (calls functions from multiple files):\n";
$sampleText = "  This is a sample text for   statistical analysis  ";
$stats = generateTextStats($sampleText);

echo "Text Statistics:\n";
echo "Original: '" . $stats['original_text'] . "'\n";
echo "Cleaned: '" . $stats['clean_text'] . "'\n";
echo "Vowel count: " . $stats['vowel_count'] . "\n";
echo "Word count: " . $stats['word_count'] . "\n";
echo "Average word length: " . $stats['average_word_length'] . "\n";
echo "Reversed: '" . $stats['reversed_text'] . "'\n\n";

// Demo 6: Showing function call chain
echo "6. Function Call Chain Demonstration:\n";
echo "main.php -> validation.php -> generateTextStats() -> cleanString() [string_utils.php]\n";
echo "                            -> countVowels() [string_utils.php]\n";
echo "                            -> calculateAverage() [math_utils.php]\n";
echo "                            -> reverseString() [string_utils.php]\n\n";

echo "=== Demo Complete ===\n";
echo "This demonstrates how functions in different PHP files can call each other!\n";

?> 