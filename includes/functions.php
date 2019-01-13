<?php
   

   function get_user_data(){
    
    global $connection;
    //global $_SESSION['username'];
    
    $user_name = $_SESSION['username'];
    
    $query = "SELECT * FROM users WHERE user_name = '$user_name'";
    
    $result = mysqli_query($connection, $query);
    
    return $row = mysqli_fetch_assoc($result);
    
}

?>