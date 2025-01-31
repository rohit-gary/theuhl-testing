<?php
// OpenAI API configuration
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../uhladmin/uhl-management/include/autoloader.inc.php');
include("../uhladmin/uhl-management/include/db-connection.php");

$core =  new Core($conn);

$all_tests = $core->_getTableRecords($conn,'doc_test','where Parsed = 0');

$k=0;

function getGPTAnswer($heading)
{
    $apiKey = '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';
    $apiUrl = 'https://api.openai.com/v1/chat/completions';
    $postData = json_encode([
        'model' => 'gpt-3.5-turbo',
        'messages' => [['role' => 'user', 'content' => $heading]],
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

        return $answer;

    } catch (Exception $e) {
        echo "Error processing $testName: " . $e->getMessage() . "\n";
    } finally {
        curl_close($ch);
    }
}
// Process each test row
foreach ($all_tests as $test) 
{
    $k++;

    // Extract required fields
    $testName = $test['TestName'];
    $ID = $test['ID'];
    $headingOne = "What is the maximum days the report can be obtained for the test $testName? (please give in detail),  please provide in HTML format, i dont need the complete body tag just the information in html format";
    $headingTwo = "What are the prerequisites for the test $testName?(please give in detail),  please provide in HTML format, i dont need the complete body tag just the information in html format ";
    $headingThree = "What are the measure values for the test $testName?(please give in detail),  please provide in HTML format, i dont need the complete body tag just the information in html format";
    $headingFour = "What does this test $testName identify?(please give in detail),  please provide in HTML format, i dont need the complete body tag just the information in html format";
    $headingFive = "Why is this test $testName taken?(please give in detail),  please provide in HTML format, i dont need the complete body tag just the information in html format";
    $headingSix = "What are the Frequently Asked Questions about the test $testName?(please give in detail),  please provide in json format Question and answer, i dont need the complete body tag just the information in html format";

    echo $headingOne . "<br>";
    echo $headingTwo . "<br>";
    echo $headingThree . "<br>";
    echo $headingFour . "<br>";
    echo $headingFive . "<br>";
    echo $headingSix . "<br>";
 
    // Parsing the data
    $descriptionOne = getGPTAnswer($headingOne);
    echo $descriptionOne . "<br>";
    $descriptionTwo = getGPTAnswer($headingTwo);
    echo $descriptionTwo . "<br>";
    $descriptionThree = getGPTAnswer($headingThree);
    echo $descriptionThree . "<br>";
    $descriptionFour = getGPTAnswer($headingFour);
    echo $descriptionFour . "<br>";
    $descriptionFive = getGPTAnswer($headingFive);
    echo $descriptionFive . "<br>";
    $descriptionSix = getGPTAnswer($headingSix);
    echo $descriptionSix . "<br>";

    $rowData = [
        'DescriptionOne' => $descriptionOne,
        'DescriptionTwo' => $descriptionTwo,
        'DescriptionThree' => $descriptionThree,
        'DescriptionFour' => $descriptionFour,
        'DescriptionFive' => $descriptionFive,
        'DescriptionSix'=> $descriptionSix,
        'Parsed'=>1    
    ];
    $whereCondition = [
        'ID' => $ID
    ];
    $response = $core->_UpdateTableRecords_prepare($conn, 'doc_test', $rowData, $whereCondition);
    var_dump($response);
    if($k==10)
    {
        break;
    }
}

echo "Updated descriptions saved to test_info_answers.csv\n";
?>