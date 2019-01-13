<?php

include "db.php";

$board_query = "SELECT * FROM messages ORDER BY id DESC";
$board_result = mysqli_query($connection, $board_query);

?>

<?php while ($row = mysqli_fetch_array($board_result)) : ?>
                    
                    
<li><?php echo $row['time']; ?> <strong><?php echo $row['name'] ?></strong>: <?php echo $row['message']; ?></li>


<?php endwhile; ?>