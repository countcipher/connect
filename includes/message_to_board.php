<?php
session_start();

include "db.php";

if(isset($_GET['received_message']) && !empty($_GET['received_message']) && $_SESSION['signed_in'] == 1){
    
    $user = $_SESSION['name'];
    $username = $_SESSION['username'];
    
    date_default_timezone_set('America/New_York');
    $time = date("m/d/y @ g:i a"); 
    //$time = date('h:i a', time());
    //$date = date("m/d/Y");
    
    $message = mysqli_real_escape_string($connection, $_GET['received_message']);
    
    $message_query = "INSERT INTO messages (user_name, name, time, message) ";
    $message_query .= "VALUES ('$username', '$user', '$time', '$message')";
    
    mysqli_query($connection, $message_query);
    
    
    
    
}



?>