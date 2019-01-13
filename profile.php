<?php
session_start();

if($_SESSION['signed_in'] != 1){
    
    session_destroy();
    header("Location: index.php?sign_in");
    die();
    
}

include "includes/db.php";

$profile_name = $_SESSION['name'];
$user_name = $_SESSION['username'];

$get_user_info_query = "SELECT * FROM users WHERE user_name = '$user_name'";

$result = mysqli_query($connection, $get_user_info_query);

$row = mysqli_fetch_assoc($result);

if(isset($_POST['edit_user_profile'])){
    
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
        
        
    $edit_query = "UPDATE users SET name = '$name', password = '$user_password' WHERE user_name = '$user_name'";
    
    mysqli_query($connection, $edit_query);
    
    $query = "SELECT * FROM users WHERE user_name = '$user_name'";
    
    $result = mysqli_query($connection, $query);
    
    $row = mysqli_fetch_assoc($result);
    
    $_SESSION['name'] = $row['name'];
    
    header("Location: profile.php?update_successful");
    
 /****************************************************
 EDIT PHOTO
 ****************************************************/   
 
if($_FILES['user_photo']['error'] == 0){
    
    unlink("images/".$row['photo']);
    
    $user_photo = $_FILES['user_photo']['name'];
    $user_photo_temp = $_FILES['user_photo']['tmp_name'];
    //$user_photo_size = $_FILES['user_photo']['size'];
    //$user_photo_error = $_FILES['user_photo']['error'];
    $user_photo_type = $_FILES['user_photo']['type'];
        
    $fileExtension = explode('.', $user_photo);
    $fileActualExtension = strtolower(end($fileExtension));
        
    $allowedExtensions = array('jpg', 'jpeg', 'png');
        
    if(in_array($fileActualExtension, $allowedExtensions)){
        
        $fileNameNew = uniqid('', 'true').".".$fileActualExtension;
        $fileDestination = 'images/'.$fileNameNew;
        
        
        
        //echo $fileDestination;
        
        move_uploaded_file($user_photo_temp, $fileDestination);
        
        $photo_update_query = "UPDATE users SET photo = '$fileNameNew' WHERE user_name = '$user_name'";
        
        mysqli_query($connection, $photo_update_query);
    
    }    
    
    
}        

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
	<link rel="stylesheet" href="css/user_profile.css">

	<script src="js/jqeury.js"></script>

	<title>Advantage Connect</title>
	
    <script>

    $(document).ready(function(){

       $("#profile_link").css("background", "rgba(0,0,0,.5)");

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
          
          <?php
           
           $get_user_info_query = "SELECT * FROM users WHERE user_name = '$user_name'";

            $result = mysqli_query($connection, $get_user_info_query);

            $row = mysqli_fetch_assoc($result);
            
            ?>

           
            <div id="user_profile" class="col-xs-8">
            
            <?php if(isset($_GET['update_successful'])) : ?>
                
            <span class="success">Update Successful</span>
                
            <?php endif; ?>
            
            <img src="images/<?php echo $row['photo']; ?>">
            
            <h2><?php echo $row['name']; ?></h2>
            
             <form action="" method="post" enctype="multipart/form-data">
                
                 <div class="form-group">
                     <label for="name">Name</label>
                     <input value="<?php echo $row['name']; ?>" name="name" type="text" class="form-control" required>
                 </div>
                 
                 
                 <div class="form-group">
                     <label for="user_password">Password</label>
                     <input value="<?php echo $row['password']; ?>" name="user_password" type="password" class="form-control" required>
                 </div>
                 
                 <div class="form-group">
                     <!--<label for="user_photo" class="btn btn-success btn-file">Add Photo </label>-->
                     <input name="user_photo" type="file">
                 </div>
                 
                 
                 <div class="form-group">
                     <input name="edit_user_profile" class="btn btn-info btn-block" type="submit" value="Edit Profile">
                 </div>
                 
             </form>
            
            </div><!--end of user_profile-->
            

            
        </div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>
