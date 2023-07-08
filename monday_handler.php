<?php
include 'config_monday.php';

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

echo "Uou need to set the POST variables first!";

?>
