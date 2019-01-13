<?php

session_start();

if($_SESSION['signed_in'] != 1){
    
    session_destroy();
    header("Location: index.php?sign_in");
    die();
    
}

if($_SESSION['user_level'] != 1){
    
    header("Location: connect.php");
    
}

include "includes/db.php";

$query = "SELECT * FROM messages ORDER BY id DESC";

$result = mysqli_query($connection, $query);

while($row = mysqli_fetch_array($result)){
    
    echo $row['time']." ".$row['user_name']." as ".$row['name'].": ".$row['message']."<br><hr>";
    
    
}



?>