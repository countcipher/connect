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

if(isset($_POST['submit_delete']) && $_SESSION['signed_in'] == 1 && $_SESSION['user_level'] == 1){
    
    $delete_all_messages_query = "DELETE FROM messages";
    
    mysqli_query($connection, $delete_all_messages_query);
    
    header("Location: delete_messages.php?all_deleted");
    
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

	
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/delete_messages.css">

	<script src="js/jqeury.js"></script>

	<title>Advantage Connect</title>
	
    <script>

    $(document).ready(function(){

       $("#delete_messages_link").css("background", "rgba(0,0,0,.5)");

    });

    $(document).ready(function(){

       setInterval(function(){

           update_board();
       }, 250); 

    });      



    </script>

</head>

<body>
    
<div id="delete_messages_modal">
    <h2>You are about to delete all content from the message board.  Press "Confirm" to continue the deleting process.</h2>
    
    <form method="post">
        
    <button type="submit" name="submit_delete" id="delete_all_messages_button" class="btn btn-danger btn-lg modal-button">Confirm</button>
    <button id="exit_delete_all_messages_modal" class="btn btn-success btn-lg modal-button">Exit</button>
        
    </form>
    
    
</div>

	<div class="container-fluid">
      
      <div class="row header">
          <div class="col-xs-12">
             <img src="images/cla.png" alt="">
              <!--<h2><img src="images/cla.png" alt="">Connect</h2>-->
          </div>
      </div>
       
        <div id="content" class="row">
          
<!--***********************************
DASHBOARD CONTROLS        
************************************-->
          
<?php include "includes/dashboard_controls.php"; ?>
           

           
            <div id="delete_messages_div" class="col-xs-8">
             
             <?php if(isset($_GET['all_deleted'])) : ?>
                
            <span class="success">Messages Successfully Deleted</span>
                
            <?php endif; ?> 
             
              <h2>Delete All Content From The Message Board</h2>
               <button id="delete_messages_modal_invoke" class="btn btn-danger">Delete Messages</button>
            </div><!--delete_messages_div-->
            

            
        </div>
	</div>

	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<script>
        
    document.getElementById("delete_messages_modal_invoke").onclick = function(){
      
        $("#delete_messages_modal").fadeIn();
        
    };
    
    document.getElementById("exit_delete_all_messages_modal").onclick = function(){
      
      $("#delete_messages_modal").fadeOut();
        
    };
    
    </script>

</body>

</html>
