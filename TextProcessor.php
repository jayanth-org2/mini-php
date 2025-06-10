<?php

// Include utility files and other classes
require_once 'math_utils.php';
require_once 'string_utils.php';
require_once 'validation.php';
require_once 'User.php';

/**
 * TextProcessor class that handles advanced text processing operations
 * Demonstrates class methods calling functions and other class methods
 */
class TextProcessor {
    private $processedTexts;
    private $statistics;

    public function __construct() {
        $this->processedTexts = [];
        $this->statistics = [
            'total_texts_processed' => 0,
            'total_words_processed' => 0,
            'total_characters_processed' => 0
        ];
    }

    /**
     * Process text and store results
     * Uses functions from validation.php
     */
    public function processText($text, $label = '') {
        $textStats = generateTextStats($text); // Call function from validation.php
        
        $processedData = [
            'label' => $label ?: 'Text_' . (count($this->processedTexts) + 1),
            'original' => $text,
            'stats' => $textStats,
            'processed_at' => date('Y-m-d H:i:s'),
            'id' => $this->generateTextId($text)
        ];

        $this->processedTexts[] = $processedData;
        $this->updateStatistics($textStats);

        return $processedData;
    }

    /**
     * Generate unique ID for text
     * Uses functions from math_utils.php and string_utils.php
     */
    private function generateTextId($text) {
        $textHash = substr(md5($text), 0, 6);
        $randomNum = generateRandomNumber(100, 999); // Call function from math_utils.php
        $randomString = generateRandomString(2); // Call function from string_utils.php
        
        return strtoupper($textHash . $randomNum . $randomString);
    }

    /**
     * Update internal statistics
     * Uses functions from math_utils.php
     */
    private function updateStatistics($textStats) {
        $this->statistics['total_texts_processed']++;
        $this->statistics['total_words_processed'] += $textStats['word_count'];
        $this->statistics['total_characters_processed'] += strlen($textStats['clean_text']);
    }

    /**
     * Get processing statistics
     * Uses functions from math_utils.php
     */
    public function getProcessingStats() {
        $wordCounts = array_map(function($text) {
            return $text['stats']['word_count'];
        }, $this->processedTexts);

        $characterCounts = array_map(function($text) {
            return strlen($text['stats']['clean_text']);
        }, $this->processedTexts);

        return [
            'basic_stats' => $this->statistics,
            'average_words_per_text' => empty($wordCounts) ? 0 : calculateAverage($wordCounts), // Call function from math_utils.php
            'average_characters_per_text' => empty($characterCounts) ? 0 : calculateAverage($characterCounts), // Call function from math_utils.php
            'total_texts' => count($this->processedTexts),
            'even_word_count_texts' => $this->countTextsWithEvenWords() // Uses math function internally
        ];
    }

    /**
     * Count texts with even word counts
     * Uses function from math_utils.php
     */
    private function countTextsWithEvenWords() {
        $count = 0;
        foreach ($this->processedTexts as $text) {
            if (isEven($text['stats']['word_count'])) { // Call function from math_utils.php
                $count++;
            }
        }
        return $count;
    }

    /**
     * Process user information and create text analysis
     * CALLS METHODS FROM User CLASS - demonstrates class-to-class calling
     */
    public function processUserInformation(User $user) {
        // Call methods from User class
        $userSummary = $user->getUserSummary(); // Call User class method
        $nameAnalysis = $user->getNameAnalysis(); // Call User class method
        
        // Create text from user information
        $userText = "User: " . $user->getDisplayName() . " (" . $user->getEmail() . ") " .
                   "Age: " . $user->getAge() . " years old. " .
                   "Name has " . $nameAnalysis['vowel_count'] . " vowels.";

        // Process the user text using our own methods
        $processedUserText = $this->processText($userText, 'User_Info_' . $user->getName());

        // Add user-specific analysis
        $processedUserText['user_data'] = $userSummary;
        $processedUserText['cross_class_analysis'] = [
            'user_name_reversed' => $nameAnalysis['reversed_name'],
            'user_stats' => $userSummary['stats'],
            'text_vs_user_age' => [
                'text_word_count' => $processedUserText['stats']['word_count'],
                'user_age' => $user->getAge(),
                'age_is_prime' => $userSummary['stats']['age_is_prime']
            ]
        ];

        return $processedUserText;
    }

    /**
     * Compare two users using text processing
     * CALLS METHODS FROM User CLASS - demonstrates multiple class interactions
     */
    public function compareUsers(User $user1, User $user2) {
        // Get data from both users by calling their methods
        $user1Summary = $user1->getUserSummary(); // Call User class method
        $user2Summary = $user2->getUserSummary(); // Call User class method

        // Create comparison text
        $comparisonText = $user1->getDisplayName() . " vs " . $user2->getDisplayName() . ". " .
                         "Ages: " . $user1->getAge() . " and " . $user2->getAge() . ". " .
                         "Names have " . $user1Summary['name_analysis']['vowel_count'] . 
                         " and " . $user2Summary['name_analysis']['vowel_count'] . " vowels respectively.";

        // Process comparison text
        $processedComparison = $this->processText($comparisonText, 'User_Comparison');

        // Add cross-class analysis
        $ageAverage = calculateAverage([$user1->getAge(), $user2->getAge()]); // Call function from math_utils.php
        
        $processedComparison['user_comparison'] = [
            'user1_data' => $user1Summary,
            'user2_data' => $user2Summary,
            'age_average' => $ageAverage,
            'age_difference' => abs($user1->getAge() - $user2->getAge()),
            'both_ages_even' => isEven($user1->getAge()) && isEven($user2->getAge()), // Call function from math_utils.php
            'name_length_comparison' => [
                'user1_length' => strlen($user1->getName()),
                'user2_length' => strlen($user2->getName()),
                'average_name_length' => calculateAverage([strlen($user1->getName()), strlen($user2->getName())]) // Call function from math_utils.php
            ]
        ];

        return $processedComparison;
    }

    /**
     * Get all processed texts
     */
    public function getAllProcessedTexts() {
        return $this->processedTexts;
    }

    /**
     * Find texts by criteria
     * Uses functions from math_utils.php
     */
    public function findTextsByCriteria($minWords = 0, $maxWords = PHP_INT_MAX) {
        $result = [];
        foreach ($this->processedTexts as $text) {
            $wordCount = $text['stats']['word_count'];
            if ($wordCount >= $minWords && $wordCount <= $maxWords) {
                $result[] = $text;
            }
        }
        return $result;
    }

    /**
     * Generate summary report
     * Uses functions from multiple files and User class methods
     */
    public function generateSummaryReport(User $user = null) {
        $report = [
            'processor_stats' => $this->getProcessingStats(),
            'total_processed_texts' => count($this->processedTexts),
            'generated_at' => date('Y-m-d H:i:s'),
            'random_text_id' => generateRandomString(8) // Call function from string_utils.php
        ];

        if ($user !== null) {
            // Call User class methods to get user information
            $report['user_info'] = [
                'display_name' => $user->getDisplayName(), // Call User class method
                'user_stats' => $user->getUserStats(), // Call User class method
                'validation_result' => $user->validateUserData() // Call User class method
            ];
        }

        return $report;
    }
}

?> 