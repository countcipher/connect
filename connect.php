<?php
session_start();



include "includes/db.php";

if((isset($_POST['sign_in']) && empty($_POST['sign_in_username']))){
    header("Location: index.php?complete_all_fields");
        die();
}

if(isset($_POST['sign_in'])){
    
    $sign_in_username = mysqli_real_escape_string($connection, $_POST['sign_in_username']);
    $sign_in_password = mysqli_real_escape_string($connection, $_POST['sign_in_password']);
    //$sign_in_password = $_POST['sign_in_password'];
    
    $sign_in_query = "SELECT * FROM users WHERE user_name = '$sign_in_username'";
    
    $result = mysqli_query($connection, $sign_in_query);
    
    $user_credentials = mysqli_fetch_assoc($result);
    
    if($user_credentials['user_name'] != $sign_in_username){
        header("Location: index.php?username_not_found");
        die();
    }
    
    if($user_credentials['password'] != $sign_in_password){
        header("Location: index.php?password_incorrect");
        session_destroy();
        die();
    }else{
        
        $_SESSION['username'] = mysqli_real_escape_string($connection, $user_credentials['user_name']);
        $_SESSION['name'] = mysqli_real_escape_string($connection, $user_credentials['name']);
        $_SESSION['user_level'] = mysqli_real_escape_string($connection, $user_credentials['user_level']);
        $_SESSION['signed_in'] = 1;
        $_SESSION['photo'] = mysqli_real_escape_string($connection, $user_credentials['photo']);
        
    }
    
    
    
    
}

if($_SESSION['signed_in'] != 1){
    
    session_destroy();
    header("Location: index.php?sign_in");
    die();
    
}

//$board_query = "SELECT * FROM messages ORDER BY id DESC";
//$board_result = mysqli_query($connection, $board_query);

//OLD CODE USED BEFORE AJAX IMPLE
/*if(isset($_POST['send_message']) && !empty($_POST['message'])){
    
    $user = $_SESSION['name'];
    
    date_default_timezone_set('America/New_York');
    $time = date("m/d/y @ g:i a"); 
    //$time = date('h:i a', time());
    //$date = date("m/d/Y");
    
    $message = mysqli_real_escape_string($connection, $_POST['message']);
    
    $message_query = "INSERT INTO messages (name, time, message) ";
    $message_query .= "VALUES ('$user', '$time', '$message')";
    
    mysqli_query($connection, $message_query);
    
}*/

?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

	
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/connect.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<title>Advantage Connect</title>

	
<script>
    
$(document).ready(function(){
    
   $("#connect_link").css("background", "rgba(0,0,0,.5)");
    
});
    
$(document).ready(function(){
    
   setInterval(function(){
       
       update_board();
   }, 250); 
    
});    
    
function update_board(){
    
  $.ajax({
      
    url: 'includes/update_board.php',
    type: 'GET',
    success: function(show_board){
        
        if(!show_board.error){
            
            $('#message-board').html(show_board);
            
        }
        
    }
      
  });  
    
};   
    
    
</script>

</head>

<body>


    
<div id="modal">
   <div class="col-xs-6 col-xs-offset-3">
       <h2>Search</h2>
        <div class="form-group">
            <input type="text" class="form-control" id="search">
            <button id="exit_modal" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Exit Search</button>
        </div>
        
        <div style="text-align: center" id="search_results" class="col-xs-8">
            <ul id="result">
                
            </ul>
        </div>
        
    </div>
</div><!--end of search modal-->

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
           

           
            <div id="message_feed" class="col-xs-8">
                <ul id="message-board">
                    
                </ul>
                
           <div id="message_input_form" class="col-xs-8">
               
               <form action="" method="post">
                   
                   <div class="form-group">
                      <!--<label for="message">Message</label>-->
                       <input id="message" name="message" type="text" class="form-control">
                       <!--<input id="send_message" name="send_message" class="btn btn-info" type="submit" value="Send">-->
                   </div>
                   
               </form>
               
               <button id="send_from_ajax" class="btn btn-success"><i class="fas fa-upload"></i> Send</button>
               <button id="search_messages" class="btn btn-info"><i class="fas fa-search"></i> Search</button>
               
           </div>                
                
            </div><!--end of messages ul-->
            

            
        </div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<script>
    
    $("#send_from_ajax").click(function(){
        
        
       var message = $("#message").val();
        
        
        $.ajax({
            
           url: "includes/message_to_board.php",
            data: {received_message: message},
            type: "GET"
            
        });
        
        document.getElementById("message").value = "";
        
    });
        
    document.getElementById("search_messages").onclick = function(){
    
      //document.getElementById("modal").style.display = "block";
        $("#modal").slideDown();

    };
    
    document.getElementById("exit_modal").onclick = function(){

        //document.getElementById("modal").style.display = "none";
        $("#modal").slideUp();

    };
        
    $("#search").keyup(function(){

        var search = $("#search").val();  //grabs the value of input #search and makes it into a variable

        // this checks to see if it's working:  alert(search);

        $.ajax({

            url: "search_messages.php", //send request to this URL
            data: {search: search}, //send superglobal whose key is the value of the variable
            type:  "GET", // type of request; had to change from POST because of GoDaddy limiting POST
            success: function(data){ //success equals this function with 'data' passed in

                if(!data.error){ //if there is no error

                    $("#result").html(data);  //this inserts the search data into the inner html of the h2 tag #result

                }

            }
        });


    });

    </script>

</body>

</html>