<?php

include "includes/db.php";

//$board_query = "SELECT * FROM messages ORDER BY id DESC";
//$board_result = mysqli_query($connection, $board_query);

if(isset($_POST['send_message']) && !empty($_POST['message'])){
    
    $user = "Chris";
    
    date_default_timezone_set('America/New_York');
    $time = date("m/d/y @ g:i a"); 
    //$time = date('h:i a', time());
    //$date = date("m/d/Y");
    
    $message = $_POST['message'];
    
    $message_query = "INSERT INTO messages (name, time, message) ";
    $message_query .= "VALUES ('$user', '$time', '$message')";
    
    mysqli_query($connection, $message_query);
    
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

	
	<link rel="stylesheet" href="css/style.css">

	<title>Advantage Connect</title>

	<style>

	</style>

</head>

<body>

	<div class="container-fluid">
      
      <div class="row header">
          <div class="col-xs-12">
              <h2>CLA Advantage Connect</h2>
          </div>
      </div>
       
        <div id="content" class="row">
          
<!--***********************************
DASHBOARD CONTROLS        
************************************-->
          
<?php include "includes/dashboard_controls.php"; ?>
           

           
            <div id="message_feed" class="col-xs-8">
                <ul>
                    <?php while ($row = mysqli_fetch_array($board_result)) : ?>
                    
                    
                    <li><?php echo $row['time']; ?> <?php echo $row['name'] ?>: <?php echo $row['message']; ?></li>
                    
                    
                    <?php endwhile; ?>
                </ul>
                
           <div id="message_input_form" class="col-xs-8">
               
               <form action="" method="post">
                   
                   <div class="form-group">
                      <!--<label for="message">Message</label>-->
                       <input name="message" type="text" class="form-control">
                       <input id="send_message" name="send_message" class="btn btn-info" type="submit" value="Send">
                   </div>
                   
               </form>
               
           </div>                
                
            </div><!--end of messages ul-->
            

            
        </div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>
