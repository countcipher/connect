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

$get_all_users_query = "SELECT * FROM users ORDER BY id DESC";

$result = mysqli_query($connection, $get_all_users_query);

                       
                       
if(isset($_POST['submit_delete']) && !empty($_POST['users_to_delete'])){


   $users_to_delete = $_POST['users_to_delete'];

   foreach($users_to_delete as $user_to_delete){

       $query = "SELECT * FROM users WHERE id = $user_to_delete";
       $result = mysqli_query($connection, $query);
       $row = mysqli_fetch_assoc($result);

       unlink("images/".$row['photo']);

       $delete_user_query = "DELETE FROM users WHERE id = '$user_to_delete'";

       mysqli_query($connection, $delete_user_query);

   }

   header("Location: delete_users.php");
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
	<link rel="stylesheet" href="css/all_users.css">
	<link rel="stylesheet" href="css/delete_users.css">

	<script src="js/jqeury.js"></script>

	<title>Advantage Connect</title>
	
    <script>

    $(document).ready(function(){

       $("#delete_users_link").css("background", "rgba(0,0,0,.5)");

    });

    $(document).ready(function(){

       setInterval(function(){

           update_board();
       }, 250); 

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
           

           <form method="post">
            <div id="users_table" class="col-xs-8">
               <table class="table table-responsive table-bordered table-striped">
                   <thead>
                       <tr>
                           <th>Photo</th>
                           <th>Name</th>
                           <th>Username</th>
                           <th>Level</th>
                           <th>Delete</th>
                       </tr>
                   </thead>
                   <tbody>
                       
                       <?php while($row = mysqli_fetch_assoc($result)) : ?>
                       
                       <tr>
                           <td><img src="images/<?php echo $row['photo']; ?>" alt=""></td>
                           <td><?php echo $row['name']; ?></td>
                           <td><?php echo $row['user_name']; ?></td>
                           <td><?php
                               
                               if($row['user_level'] == 0){
                                   
                                   echo "User";
                                   
                               }else{
                                   
                                   echo "Administrator";
                                   
                               }
                               
                                ?></td>
                           <td><input type="checkbox" name="users_to_delete[]" value="<?php echo $row['id']; ?>"> Delete</td>
                       </tr>
                       
                       <?php endwhile; ?>
                       
                       
                   </tbody>
               </table>
               
            </div><!--end of users table-->
            
            <div class="col-xs-8">
                
                   <div class="form-group">
                       <input class="btn btn-danger btn-block" type="submit" name="submit_delete" value="Delete">
                   </div>
               
            </div>      
            </form>          

            
        </div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>
