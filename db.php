<?php 

include 'config.php';

$connection = mysqli_connect($dbHost, $dbUserName, $dbPassword, $dbName);

if(!$connection){
    die("Connection failed: " . mysqli_connect_error());
}

function excecute_query($query){
    global $connection;
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("Query failed: " . mysqli_error($connection));
    }
    
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
    $result = json_encode($emparray);
    return $result;
}