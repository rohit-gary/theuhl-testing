<?php
require '../vendor/autoload.php'; // Make sure to install OpenAI PHP SDK via Composer
use OpenAI\Client;



// OpenAI API configuration
$openai = OpenAI::client('');

$tests = array("Platelet Count Test", "Hemoglobin (Hb) Test", "TLC (Total Leucocyte Count) Test", "ESR Test", "Absolute Eosinophil Count (AEC) Test");

foreach ($tests as $test) {
    // Prepare the prompt for OpenAI
    $prompt = "I want to know following information about the medical test: $test\n\n" .
        "1. What is the maximum days the report can be obtained for the test?\n" .
        "2. What are the prerequisites for the test?\n" .
        "3. What are the measure values for the test?\n" .
        "4. What does it identify?\n" .
        "5. What is the test about?\n" .
        "6. Why is the test taken?\n" .
        "7. What are the results about and what is their interpretation?\n" .
        "8. What are the Frequently Asked Questions about this test?\n\n" .
        "Please provide the answers in a structured format.";

    try {
        // Get response from OpenAI
        $response = $openai->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.7,
        ]);

        $answer = $response->choices[0]->message->content;

        // Print the information
        echo "\n=== Information for $test ===\n";
        echo $answer . "\n";
        echo "================================\n\n";

        // Sleep to respect API rate limits
        sleep(1);

    } catch (Exception $e) {
        echo "Error processing $test: " . $e->getMessage() . "\n";
    }
}
?>