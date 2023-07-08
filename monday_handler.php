<?php
// Replace with your Monday.com API Key and Board ID
include 'config_monday.php';


// Enable error logging
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');
// $firstName = "John";
// $lastName = "Doe";
// $email = "johndoe@example.com";
// $phone = "+123456789";
// $date = "2023-07-05";
// $company = "acme";
// $message = "blblblblbllbblblb";
// $query = 'mutation {create_item (board_id: 4752380869, group_id: "topics", item_name: "'.$firstName.' '.$lastName.'", column_values: "{\\"status\\" : \\"Done\\", \\"text\\" : \\"My Text\\", \\"date4\\" : \\"'.$date.'\\", \\"text\\" : \\"'.$firstName.' '.$lastName.'\\", \\"phone\\" : \\"'.$phone.'\\", \\"email\\" : {\\"email\\" : \\"'.$email.'\\", \\"text\\" : \\"'.$email.'\\"}, \\"text6\\" : \\"'.$company.'\\", \\"long_text\\" : \\"'.$message.'\\"}") {id}}';
if (isset($_POST['phone']))
{
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = date("Y-m-d");
    $company = $_POST['company'];
    $message = $_POST['message'];
    $query = 'mutation {create_item (board_id: 4752380869, group_id: "topics", item_name: "'.$firstName.' '.$lastName.'", column_values: "{\\"status\\" : \\"Done\\", \\"text\\" : \\"My Text\\", \\"date4\\" : \\"'.$date.'\\", \\"text\\" : \\"'.$firstName.' '.$lastName.'\\", \\"phone\\" : \\"'.$phone.'\\", \\"email\\" : {\\"email\\" : \\"'.$email.'\\", \\"text\\" : \\"'.$email.'\\"}, \\"text6\\" : \\"'.$company.'\\", \\"long_text\\" : \\"'.$message.'\\"}") {id}}';
    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['query' => $query]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: ' . $apiKey,
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session and get the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        $error = 'cURL Error: ' . curl_error($ch);
        error_log($error);
        echo $error;
    }

    // Close cURL session
    curl_close($ch);

    // Output the response from Monday.com
    echo $response;
}

echo "Hello World!";
// Define the query
// $query = 'mutation {create_item (board_id: 4752380869, group_id: "topics", item_name: "new item", column_values: "{\"status\" : \"Done\\", \"text\\" : \"My Text\\", \"date4\\" : \"2023-07-05\", \"text\" : \"John due\", \"phone\" : \"+123456789\", \"email\" : {\"email\" : \"example@example.com\", \"text\" : \"This is an example email\"}, \"text6\" : \"acme\", \"long_text\" : \"blblblblbllbblblb\"}") {id}}';

// Set the variables


?>
