<?php 

include 'db.php';

$selectQuery = "SELECT * FROM portfolio_OrBasker";
$result = excecute_query($selectQuery);
$resultArray = json_decode($result, true);
foreach($resultArray as $row){
    if (!empty($row['technology_used'])) {
        $row['technology_used'] = explode(",", $row['technology_used']);
    } else {
        $row['technology_used'] = array(); 
    }
}

$response = json_encode($resultArray);
echo $response;