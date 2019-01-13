<?php

//include "includes/functions.php";

    $dashboard_user_name = $_SESSION['username'];
    
    $dashboard_query = "SELECT * FROM users WHERE user_name = '$dashboard_user_name'";
    
    $dashboard_result = mysqli_query($connection, $dashboard_query);
    
    $dashboard_row = mysqli_fetch_assoc($dashboard_result);

?>
  

  
<div id="user_dashboard" class="col-xs-4">
  
  <div id="dashboard_inner_wrapper">

  <ul>
      <li><img src="images/<?php echo $dashboard_row['photo']; ?>" alt=""> <?php echo $_SESSION['name']; ?></li>
      <a href="connect.php"><li id="connect_link"><i class="fas fa-comments"></i> Message Board</li></a>
      <a href="library.php"><li id="library_link"><i class="fas fa-book"></i> Library</li></a>
      <a href="all_users.php"><li id="all_users_link"><i class="fas fa-users"></i> All Users</li></a>
      
      <!--ADMIN RESTRICTED FUNCTIONS-->
      
      <?php if($_SESSION['user_level'] == 1) : ?>
      
      <a href="add_user.php"><li id="add_user_link"><i class="fas fa-user-plus"></i> Add User</li></a>
      <a href="delete_users.php"><li id="delete_users_link"><i class="fas fa-user-slash"></i> Delete Users</li></a>
      <a target="_blank" href="archive.php"><li><i class="fas fa-archive"></i> Archive</li></a>
      <a href="delete_messages.php"><li id="delete_messages_link"><i class="fas fa-trash-alt"></i> Delete Messages</li></a>
      <a href="delete_from_library.php"><li id="delete_from_library_link"><i class="fas fa-book-dead"></i> Delete From Library</li></a>
      
      <?php endif; ?>
      
      <!--END ADMIN RESTRICTED FUNCITONS-->      
      <a href="profile.php"><li id="profile_link"><i class="fas fa-users-cog"></i> Profile</li></a>
      <a href="sign_out.php"><li><i class="fas fa-power-off"></i> Sign Out</li></a>
  </ul>
  
    </div>

</div>