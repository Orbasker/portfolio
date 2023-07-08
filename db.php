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
    
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $result = json_encode($result);
    return $result;
}