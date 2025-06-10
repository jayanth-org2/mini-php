<?php

// Include all files
require_once 'math_utils.php';
require_once 'string_utils.php';
require_once 'validation.php';
require_once 'User.php';
require_once 'TextProcessor.php';

echo "=== PHP Classes Cross-File Calling Demo ===\n\n";

// Demo 1: Create User objects and show they use utility functions
echo "1. Creating User Objects (classes calling utility functions):\n";
$user1 = new User("  john doe  ", "john@example.com", 25);
$user2 = new User("jane smith", "jane@example.com", 30);

echo "User 1 Display Name: " . $user1->getDisplayName() . " (uses capitalizeWords from string_utils.php)\n";
echo "User 2 Display Name: " . $user2->getDisplayName() . "\n";

// Show password generation (User class calling validation.php functions)
echo "\nPassword Generation (User class -> validation.php -> utility functions):\n";
$password1 = $user1->generatePassword();
echo "Generated password for " . $user1->getDisplayName() . ": $password1\n";

// Show user statistics (User class calling math_utils.php functions)
echo "\nUser Statistics (User class calling math_utils.php functions):\n";
$stats1 = $user1->getUserStats();
print_r($stats1);

echo "\n";

// Demo 2: Create TextProcessor and show it calls User class methods
echo "2. TextProcessor calling User class methods:\n";
$processor = new TextProcessor();

// TextProcessor calling User class methods
echo "Processing User Information (TextProcessor -> User class methods):\n";
$processedUser1 = $processor->processUserInformation($user1);
echo "Processed user text: '" . $processedUser1['original'] . "'\n";
echo "User data from cross-class call:\n";
echo "- Display name: " . $processedUser1['user_data']['name'] . "\n";
echo "- Age is prime: " . ($processedUser1['user_data']['stats']['age_is_prime'] ? 'Yes' : 'No') . "\n";
echo "- Vowel count in name: " . $processedUser1['user_data']['name_analysis']['vowel_count'] . "\n\n";

// Demo 3: TextProcessor comparing users (calling multiple User methods)
echo "3. TextProcessor comparing Users (calling multiple User class methods):\n";
$comparison = $processor->compareUsers($user1, $user2);
echo "Comparison text: '" . $comparison['original'] . "'\n";
echo "User comparison analysis:\n";
echo "- Average age: " . $comparison['user_comparison']['age_average'] . "\n";
echo "- Age difference: " . $comparison['user_comparison']['age_difference'] . "\n";
echo "- Both ages even: " . ($comparison['user_comparison']['both_ages_even'] ? 'Yes' : 'No') . "\n";
echo "- Average name length: " . $comparison['user_comparison']['name_length_comparison']['average_name_length'] . "\n\n";

// Demo 4: Show complex call chains
echo "4. Complex Call Chains:\n";
echo "User ID Generation (User class -> math_utils.php + string_utils.php):\n";
echo "User 1 ID: " . $user1->generateUserId() . "\n";
echo "User 2 ID: " . $user2->generateUserId() . "\n\n";

// Demo 5: TextProcessor using utility functions directly
echo "5. TextProcessor using utility functions directly:\n";
$processor->processText("This is a sample text for processing and analysis");
$processor->processText("Another text with different content and length");
$processor->processText("Short text");

$processingStats = $processor->getProcessingStats();
echo "Processing Statistics:\n";
echo "- Total texts processed: " . $processingStats['total_texts'] . "\n";
echo "- Average words per text: " . round($processingStats['average_words_per_text'], 2) . "\n";
echo "- Texts with even word count: " . $processingStats['even_word_count_texts'] . "\n\n";

// Demo 6: Generate summary report (TextProcessor calling User methods)
echo "6. Summary Report (TextProcessor -> User class methods):\n";
$summaryReport = $processor->generateSummaryReport($user1);
echo "Report generated at: " . $summaryReport['generated_at'] . "\n";
echo "User in report: " . $summaryReport['user_info']['display_name'] . "\n";
echo "User validation: " . ($summaryReport['user_info']['validation_result']['valid'] ? 'Valid' : 'Invalid') . "\n";
echo "Random text ID: " . $summaryReport['random_text_id'] . "\n\n";

// Demo 7: Show the complete call chain
echo "7. Complete Call Chain Examples:\n";
echo "Example 1: TextProcessor->processUserInformation():\n";
echo "  TextProcessor.php -> processUserInformation()\n";
echo "                    -> User.getUserSummary() [User.php]\n";
echo "                    -> User.getNameAnalysis() [User.php]\n";
echo "                       -> countVowels() [string_utils.php]\n";
echo "                       -> reverseString() [string_utils.php]\n";
echo "                       -> isAlphabetic() [string_utils.php]\n";
echo "                    -> generateTextStats() [validation.php]\n";
echo "                       -> cleanString() [string_utils.php]\n";
echo "                       -> calculateAverage() [math_utils.php]\n\n";

echo "Example 2: User->generateUserId():\n";
echo "  User.php -> generateUserId()\n";
echo "           -> generateRandomNumber() [math_utils.php]\n";
echo "           -> generateRandomString() [string_utils.php]\n\n";

echo "Example 3: TextProcessor->compareUsers():\n";
echo "  TextProcessor.php -> compareUsers()\n";
echo "                    -> User.getUserSummary() x2 [User.php]\n";
echo "                    -> User.getDisplayName() x2 [User.php]\n";
echo "                       -> capitalizeWords() [string_utils.php]\n";
echo "                    -> calculateAverage() [math_utils.php]\n";
echo "                    -> isEven() [math_utils.php]\n\n";

// Demo 8: Show User class validation features
echo "8. User Class Validation (calling validation.php functions):\n";
$user3 = new User("test user", "test@example.com", 17);
$validationResult = $user3->validateUserData();
echo "User 3 validation:\n";
echo "- Valid: " . ($validationResult['valid'] ? 'Yes' : 'No') . "\n";
echo "- Clean name: '" . $validationResult['clean_name'] . "'\n";
echo "- Age is prime: " . ($validationResult['is_prime_age'] ? 'Yes' : 'No') . "\n";

// Test password validation
$passwordTest = $user3->setPassword("weak");
if ($passwordTest !== true) {
    echo "Password validation errors:\n";
    foreach ($passwordTest as $error) {
        echo "- $error\n";
    }
}

echo "\n=== Class Demo Complete ===\n";
echo "This demonstrates:\n";
echo "✅ Classes calling utility functions from other files\n";
echo "✅ Classes calling methods from other classes\n";
echo "✅ Complex call chains across multiple files\n";
echo "✅ Object-oriented design with cross-file dependencies\n";

?> 