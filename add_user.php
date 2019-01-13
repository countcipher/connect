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
    

if(isset($_POST['add_user_submit'])){
    
    if(!empty($_POST['name']) && !empty($_POST['user_name']) && !empty($_POST['user_password'])){
        
        
   
        
        
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $user_name = mysqli_real_escape_string($connection, $_POST['user_name']);
    $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
        
        
    $query = "SELECT * FROM users";
    $result = mysqli_query($connection, $query);
    
        
    while($row = mysqli_fetch_assoc($result)){
       
        if($user_name == $row['user_name']){
            
            header("Location: add_user.php?dulicate_user_name");
            die();
            
        }
        
    }
    
    
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
        
    }else{
        
        header("Location: add_user.php?photo_error");
        die();
        
    }
        
    $user_level = $_POST['user_level'];
    
    
    $add_user_query = "INSERT INTO users (user_level, name, user_name, password, photo) "; 
    $add_user_query.= "VALUES ('$user_level', '$name', '$user_name', '$user_password', '$fileNameNew')";
    
    mysqli_query($connection, $add_user_query);
    
    header("Location: add_user.php?user_set=1");        
        
        
    }else{
        
        header("Location: add_user.php?error=1");
        
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
	<link rel="stylesheet" href="css/add_users.css">
	
	<script src="js/jqeury.js"></script>

	<title>Advantage Connect</title>
	
<script>
    
$(document).ready(function(){
    
   $("#add_user_link").css("background", "rgba(0,0,0,.5)");
    
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
           

           
            <div id="add_user_content" class="col-xs-8">
            
            <?php if(isset($_GET['user_set'])) : ?>
                
            <span class="success">User Successfully Added</span>
                
            <?php endif; ?> 
               
            <?php if(isset($_GET['error'])) : ?>
                
            <span class="error">All Fields Must Be Completed</span>
                
            <?php endif; ?>
               
            <?php if(isset($_GET['photo_error'])) : ?>
                
            <span class="error">Select Correct Image Type</span>
                
            <?php endif; ?>
               
            <?php if(isset($_GET['dulicate_user_name'])) : ?>
                
            <span class="error">Duplicate User Name</span>
                
            <?php endif; ?>              
                
            
            
             <form action="" method="post" enctype="multipart/form-data">
                
                 <div class="form-group">
                     <label for="name">Name</label>
                     <input name="name" type="text" class="form-control" required>
                 </div>
                 
                 <div class="form-group">
                     <label for="user_name">User Name</label>
                     <input name="user_name" type="text" class="form-control" required>
                 </div>
                 
                 <div class="form-group">
                     <label for="user_password">Password</label>
                     <input name="user_password" type="password" class="form-control" required>
                 </div>
                 
                 <div class="form-group">
                     <!--<label for="user_photo" class="btn btn-success btn-file">Add Photo </label>-->
                     <input name="user_photo" type="file" required>
                 </div>
                 
                 <div class="form-group">
                     <select name="user_level">
                        <option disabled selected option>User Level</option>
                         <option value="0">User</option>
                         <option value="1">Administrator</option>
                     </select>
                 </div>
                 
                 <div class="form-group">
                     <input name="add_user_submit" class="btn btn-info btn-block" type="submit" value="Add User">
                 </div>
                 
             </form>
            </div><!--end of main content-->
            
        </div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>
