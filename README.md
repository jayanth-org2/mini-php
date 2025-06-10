# PHP Cross-File Function Calling Demo

This repository demonstrates how PHP functions in different files can call each other using `require_once` statements.

## File Structure

```
php-kg/
├── math_utils.php      # Mathematical utility functions
├── string_utils.php    # String manipulation functions  
├── validation.php      # Validation functions (uses both math and string utils)
├── main.php           # Main demo file (uses all other files)
├── User.php           # User class (calls utility functions)
├── TextProcessor.php  # TextProcessor class (calls utility functions and User methods)
├── class_demo.php     # Demo file showing class interactions
└── README.md          # This file
```

## Files Description

### 1. `math_utils.php`
Contains mathematical utility functions:
- `calculateAverage($numbers)` - Calculate average of array
- `isEven($number)` - Check if number is even
- `generateRandomNumber($min, $max)` - Generate random number in range
- `factorial($n)` - Calculate factorial
- `isPrime($number)` - Check if number is prime

### 2. `string_utils.php`
Contains string manipulation functions:
- `capitalizeWords($text)` - Capitalize first letter of each word
- `generateRandomString($length)` - Generate random string
- `countVowels($text)` - Count vowels in text
- `reverseString($text)` - Reverse a string
- `isAlphabetic($text)` - Check if string contains only letters
- `cleanString($text)` - Remove extra spaces

### 3. `validation.php`
Contains validation functions that **call functions from other files**:
- `validatePassword($password)` - Uses `countVowels()` and `isAlphabetic()` from string_utils.php
- `generateStrongPassword()` - Uses `generateRandomNumber()` from math_utils.php and `generateRandomString()` from string_utils.php
- `validateUserInput($name, $age)` - Uses multiple functions from both utility files
- `generateTextStats($text)` - Uses functions from both math_utils.php and string_utils.php

### 4. `main.php`
Demonstrates the usage of all functions and shows how they call each other across files.

### 5. `User.php`
Contains the User class that **calls utility functions from other files**:
- Constructor uses `cleanString()` from string_utils.php
- `getDisplayName()` uses `capitalizeWords()` from string_utils.php
- `setPassword()` and `generatePassword()` use functions from validation.php
- `getUserStats()` uses `calculateAverage()`, `isEven()`, `isPrime()` from math_utils.php
- `getNameAnalysis()` uses multiple functions from string_utils.php
- `generateUserId()` uses functions from both math_utils.php and string_utils.php

### 6. `TextProcessor.php`
Contains the TextProcessor class that **calls both utility functions AND User class methods**:
- `processText()` uses `generateTextStats()` from validation.php
- `generateTextId()` uses functions from both math_utils.php and string_utils.php
- `getProcessingStats()` uses `calculateAverage()` and `isEven()` from math_utils.php
- `processUserInformation()` **calls multiple User class methods**
- `compareUsers()` **calls User class methods from two different User objects**
- `generateSummaryReport()` **calls User class methods** and utility functions

### 7. `class_demo.php`
Demonstrates how classes interact with each other and call functions across files.

## Function Call Chain Examples

Here are some examples of how functions call each other across files:

1. **Password Validation Chain:**
   ```
   main.php -> validatePassword() [validation.php] 
            -> countVowels() [string_utils.php]
            -> isAlphabetic() [string_utils.php]
   ```

2. **Text Statistics Chain:**
   ```
   main.php -> generateTextStats() [validation.php]
            -> cleanString() [string_utils.php]
            -> countVowels() [string_utils.php]  
            -> calculateAverage() [math_utils.php]
            -> reverseString() [string_utils.php]
   ```

3. **Strong Password Generation Chain:**
   ```
   main.php -> generateStrongPassword() [validation.php]
            -> generateRandomNumber() [math_utils.php]
            -> generateRandomString() [string_utils.php]
   ```

4. **Class-to-Class Method Calling:**
   ```
   class_demo.php -> TextProcessor.processUserInformation() [TextProcessor.php]
                  -> User.getUserSummary() [User.php]
                  -> User.getNameAnalysis() [User.php]
                     -> countVowels() [string_utils.php]
                     -> reverseString() [string_utils.php]
   ```

5. **Class-to-Function Calling:**
   ```
   class_demo.php -> User.generateUserId() [User.php]
                  -> generateRandomNumber() [math_utils.php]
                  -> generateRandomString() [string_utils.php]
   ```

## Prerequisites

You need PHP installed on your system. 

### Install PHP on macOS:
```bash
# Using Homebrew
brew install php

# Or using MacPorts
sudo port install php81
```

### Install PHP on Linux:
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install php

# CentOS/RHEL
sudo yum install php
```

## How to Run

1. Clone or download this repository
2. Navigate to the project directory
3. Run the demos:
   ```bash
   # Function-based demo
   php main.php
   
   # Class-based demo (shows class interactions)
   php class_demo.php
   ```

## Expected Output

### `main.php` will demonstrate:
1. Direct usage of math utility functions
2. Direct usage of string utility functions
3. Password validation (calls functions from multiple files)
4. User input validation (calls functions from multiple files)
5. Text statistics generation (calls functions from multiple files)
6. Function call chain visualization

### `class_demo.php` will demonstrate:
1. Classes calling utility functions from other files
2. Classes calling methods from other classes (class-to-class interaction)
3. Complex object-oriented call chains across multiple files
4. User object creation and manipulation
5. TextProcessor processing User objects
6. Cross-class data sharing and analysis

## Key Features Demonstrated

### Function-Based Features:
- ✅ **Cross-file function calls**: Functions in one file calling functions from other files
- ✅ **Proper file inclusion**: Using `require_once` to include dependencies
- ✅ **Modular design**: Separating concerns into different utility files
- ✅ **Function reusability**: Same functions used in multiple contexts
- ✅ **Complex function chains**: Functions calling multiple other functions from different files

### Class-Based Features:
- ✅ **Class-to-function calls**: Class methods calling functions from utility files
- ✅ **Class-to-class method calls**: Methods in one class calling methods from another class
- ✅ **Object-oriented cross-file dependencies**: Classes depending on functions and other classes from different files
- ✅ **Complex OOP call chains**: Class methods calling other class methods which then call utility functions
- ✅ **Encapsulation with external dependencies**: Classes maintaining internal state while using external functions

### Advanced Patterns:
- ✅ **Mixed paradigms**: Both procedural functions and OOP classes working together
- ✅ **Dependency injection**: Classes accepting other class instances as parameters
- ✅ **Layered architecture**: Utility functions → Validation functions → Class methods → Cross-class interactions

This demonstrates both procedural and object-oriented approaches to PHP development, showing how functionality can be properly separated, reused, and interconnected across different files and paradigms. 