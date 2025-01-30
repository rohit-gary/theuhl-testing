<?php
// OpenAI API configuration
$apiKey = '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';
$apiUrl = 'https://api.openai.com/v1/chat/completions';

// Open the input CSV file
$inputCsvFile = fopen('doc_test_ques.csv', 'r');

// Open a new CSV file for output
$outputCsvFile = fopen('test_info_answers.csv', 'w');

// Read the headers
$headers = fgetcsv($inputCsvFile);
fputcsv($outputCsvFile, $headers); // Write headers to the output file

// Process each test row
while ($row = fgetcsv($inputCsvFile)) {
  // Extract required fields
  $testName = $row[1];
  $headingOne = "What is the maximum days the report can be obtained for the test?";
  $headingTwo = "What are the prerequisites for the test?";
  $headingThree = "What are the measure values for the test?";
  $headingFour = "What does it identify?";


  // Construct prompt for OpenAI
  $prompt = "Provide detailed descriptions for the following medical test based on given headings:\n\n";
  $prompt .= "Test Name: $testName\n\n";

  if (!empty($headingOne)) {
    $prompt .= "Heading: $headingOne\nDescription: $descriptionOne\n\n";
  }
  if (!empty($headingTwo)) {
    $prompt .= "Heading: $headingTwo\nDescription: $descriptionTwo\n\n";
  }
  if (!empty($headingThree)) {
    $prompt .= "Heading: $headingThree\nDescription: $descriptionThree\n\n";
  }
  if (!empty($headingFour)) {
    $prompt .= "Heading: $headingFour\nDescription: $descriptionFour\n\n";
  }

  $prompt .= "Provide at least 8-10 detailed sentences for each heading's and save in  related description. like for heading one description one and so on. its not look in perfect formation increaing row size but its look like a paragraph for each heading and description. for each test . dont write description in same row increase row size and make it look like a paragraph. and give a two row space for each test when complte description for related heading ";

  // API request to OpenAI
  $postData = json_encode([
    'model' => 'gpt-3.5-turbo',
    'messages' => [['role' => 'user', 'content' => $prompt]],
    'temperature' => 0.7,
  ]);

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $apiUrl);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: ' . "Bearer $apiKey",
  ]);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

  try {
    // Execute request
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
      throw new Exception('cURL Error: ' . curl_error($ch));
    }

    // Parse response
    $responseData = json_decode($response, true);
    $answer = $responseData['choices'][0]['message']['content'] ?? '';

    // Extract detailed descriptions for each heading
    $updatedDescriptions = ["", "", "", ""]; // Default empty descriptions
    $answerLines = explode("\n\n", $answer);

    foreach ($answerLines as $section) {
      $lines = explode("\n", $section);
      if (count($lines) > 1) {
        $heading = trim(str_replace("Heading:", "", $lines[0]));
        $description = trim(implode(" ", array_slice($lines, 1)));

        if ($heading === $headingOne)
          $updatedDescriptions[0] = $description;
        if ($heading === $headingTwo)
          $updatedDescriptions[1] = $description;
        if ($heading === $headingThree)
          $updatedDescriptions[2] = $description;
        if ($heading === $headingFour)
          $updatedDescriptions[3] = $description;
      }
    }

    // Update the row with new descriptions
    $row[17] = $updatedDescriptions[0];
    $row[18] = $updatedDescriptions[1];
    $row[19] = $updatedDescriptions[2];
    $row[20] = $updatedDescriptions[3];

    // Write updated row to output CSV
    fputcsv($outputCsvFile, $row);

    // Respect API rate limits
    sleep(1);
  } catch (Exception $e) {
    echo "Error processing $testName: " . $e->getMessage() . "\n";
  } finally {
    curl_close($ch);
  }
}

// Close files
fclose($inputCsvFile);
fclose($outputCsvFile);

echo "Updated descriptions saved to test_info_answers.csv\n";
?>