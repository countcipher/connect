<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

	
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/index.css">

	<title>Advantage Connect</title>


	<style>

	</style>

</head>

<body>

	<div class="container-fluid">
      <div id="login_panel" class="row">
          <div class="col-md-8 col-md-offset-2">
                <h1>CLA Advantage Connect</h1>
                
                <?php if(isset($_GET['sign_in'])) : ?>
                
                <span class="error">Access Denied Without Signing In</span>

                <?php endif; ?>
                
                <?php if(isset($_GET['complete_all_fields'])) : ?>
                
                <span class="error">All Fields Must Be Completed</span>

                <?php endif; ?>
                
                <?php if(isset($_GET['username_not_found'])) : ?>
                
                <span class="error">Username Not Found</span>
                
                <?php endif; ?>
                
                <?php if(isset($_GET['password_incorrect'])) : ?>
                
                <span class="error">Password Incorrect</span>
                
                <?php endif; ?>
              
                <form action="connect.php" method="post" class="form-horizontal">
                 
                  <div class="form-group">
                    <!--<label for="inputEmail3" class="col-sm-12">Username</label>-->
                    <div class="col-sm-8 col-sm-offset-2">
                      <input name="sign_in_username" type="text" class="form-control" placeholder="Username">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <!--<label for="inputPassword3" class="col-sm-2 control-label">Password</label>-->
                    <div class="col-sm-8 col-sm-offset-2">
                      <input name="sign_in_password" type="password" class="form-control" id="inputPassword3" placeholder="Password">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                     <input name="sign_in" class="btn btn-info" type="submit" value="Sign In">
                    </div>
                  </div>
                </form>
              
          </div>
      </div>
    
    
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>
