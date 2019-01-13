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

/*$dbh = new PDO("mysql:host=localhost; dbname=cl_connect", "mes_admin1123", "cOQgp2dIBHfBMm3x");
if(isset($_POST['submit']) && $_FILES['library_file']['error'] == 0){
    
    $library_file_name = $_FILES['library_file']['name'];
    $library_file_type = $_FILES['library_file']['type'];
    $library_file_data = file_get_contents($_FILES['library_file']['tmp_name']);
    
    $file_description = $_POST['file_description'];
    
    
    
   //$stmt = $dbh->prepare("insert into library values ('',?,?,?)");
   $stmt = $dbh->prepare("insert into library values ('',?,?,?,?)");//This is my attempt to insert $file_description
    $stmt->bindParam(1,$library_file_name);
    $stmt->bindParam(2,$library_file_type);
    $stmt->bindParam(3,$library_file_data);
    $stmt->bindParam(4,$file_description);
    $stmt->execute();
    
    
    
}*/

if(isset($_POST['delete_files']) && !empty($_POST['files_do_delete'])){
    
   $files_to_delete = $_POST['files_do_delete'];
    
    foreach($files_to_delete as $file_to_delete){
        
        $query = "DELETE FROM library WHERE id = '$file_to_delete'";
        
        mysqli_query($connection, $query);
        
    }
    
    header("Location: delete_from_library.php");
    
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
	<link rel="stylesheet" href="css/library.css">
	<link rel="stylesheet" href="css/delete_from_library.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script src="js/jqeury.js"></script>

	<title>Advantage Connect</title>
	
    <script>

    $(document).ready(function(){

       $("#delete_from_library_link").css("background", "rgba(0,0,0,.5)");

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
           
            <div style="padding: 0 !important" class="col-xs-8">
           <form action="" method="post">
            <div id="library_table_div" class="col-xs-12">
              
                <table id="library_table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>File</th>
                            <th>Description</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                
               /* $stat = $dbh->prepare("select * from library ORDER BY id DESC");
                $stat->execute();
                while($row = $stat->fetch()){
                    echo "<li><a target='blank' href='view.php?id=".$row['id']."'>".$row['name']."</li>";
                }*/
                    
                $query = "SELECT * FROM library ORDER BY id DESC";
                $result = mysqli_query($connection, $query);
                
                ?>
                
                     
                <?php while($row = mysqli_fetch_assoc($result)) : ?>
                
                <tr>
                    <td><a target="_blank" href="view.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><input type="checkbox" name="files_do_delete[]" value="<?php echo $row['id']; ?>"> Delete File</td>
                </tr>
                
                <?php endwhile; ?>
                
                      
                    </tbody>
                </table>
               
                           
                
            </div><!--end of library div-->
            
            <input type="submit" value="Delete Files" name="delete_files" class="btn btn-danger btn-block"> 
            
            </form>
            </div>
<!--           <div id="files_input_form" class="col-xs-8">
               
               
                 <form method="post" enctype="multipart/form-data">
                     
                     <div class="form-group">

                     
                         <input name="library_file" type="file">
                         
                         <input type="text" name="file_description" placeholder="Description">
                     


                     
                         <input name="submit" class="btn btn-info" type="submit" value="Upload File">
                     </div>

                 </form>              
              

               
           </div> -->
            
        </div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>
