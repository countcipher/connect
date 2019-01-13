<?php 

include "includes/db.php";

//Below had to be changed to a POST for GoDaddy; GD limits POST
$search = mysqli_real_escape_string($connection, $_GET['search']);

// just this will send what is typed in the input to #result
// echo $search;

if(!empty($search)){
    
    
    // $query = "SELECT * FROM people WHERE name LIKE '%$search%'";
    $query = "SELECT * FROM messages WHERE message LIKE '%$search%' OR name LIKE '%$search%' OR time LIKE '%$search%' ORDER BY id DESC";
    
    
    $search_query = mysqli_query($connection, $query);
    
    if(!$search_query){
        
        die("QUERY FAILED ".mysqli_error($connection));
        
    } ?>
    
    <?php while($row = mysqli_fetch_assoc($search_query)) : ?>
           
        <li><?php echo $row['time']; ?> <strong><?php echo $row['name'] ?></strong>: <?php echo $row['message']; ?></li>
           
    <?php endwhile; ?>
            
<?php }

?>