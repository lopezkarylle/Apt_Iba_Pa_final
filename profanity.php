<?php

$profanityList = array(
    "badword1",
    "badword2",
    "badword3",
    // Add more profanity words here
);

$userInput = $_POST['user_input'];

$containsProfanity = false;

foreach ($profanityList as $profanity) {
    if (stripos($userInput, $profanity) !== false) {
        $containsProfanity = true;
        break;
    }
}

if ($containsProfanity) {
    echo "Input contains profanity. Please enter a valid input.";
} else {
    // Process the valid input
    echo "Input is valid.";
}