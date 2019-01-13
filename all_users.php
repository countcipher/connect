<?php
session_start();

if($_SESSION['signed_in'] != 1){
    
    session_destroy();
    header("Location: index.php?sign_in");
    die();
    
}

include "includes/db.php";

$get_all_users_query = "SELECT * FROM users ORDER BY id DESC";

$result = mysqli_query($connection, $get_all_users_query);

?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

	
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/all_users.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<title>Advantage Connect</title>
	
	<script>
    
    $(document).ready(function(){
    
        $("#all_users_link").css("background", "rgba(0,0,0,.5)");
    
    });
    
    
    </script>

</head>

<body>

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
           

           
            <div id="users_table" class="col-xs-8">
               <table class="table table-responsive table-bordered table-striped">
                   <thead>
                       <tr>
                           <th>Photo</th>
                           <th>Name</th>
                           <th>Username</th>
                           <th>Level</th>
                       </tr>
                   </thead>
                   <tbody>
                       
                       <?php while($row = mysqli_fetch_assoc($result)) : ?>
                       
                       <tr>
                           <td><img src="images/<?php echo $row['photo']; ?>" alt=""></td>
                           <td><?php echo $row['name']; ?></td>
                           
                           
                           
                           <td><?php 
                               
                               if($_SESSION['user_level'] == 1){
                                   echo $row['user_name'];
                               }else{
                                   echo "Admin View Only";
                               }
                               ?>
                               </td>
                           
                           
                           
                           <td><?php 
                            
                               if($row['user_level'] == 0){
                                   echo "User";
                               }else{
                                   echo "Administrator";
                               }
                               
                            ?></td>
                       </tr>
                       
                       <?php endwhile; ?>
                       
                   </tbody>
               </table>
            </div><!--end of users table-->
            

            
        </div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>
