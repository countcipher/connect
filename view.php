<?php

session_start();

if($_SESSION['signed_in'] != 1){
    
    session_destroy();
    header("Location: index.php?sign_in");
    die();
    
}

$dbh = new PDO("mysql:host=localhost; dbname=cl_connect", "mes_admin1123", "cOQgp2dIBHfBMm3x");

$id = isset($_GET['id'])? $_GET['id'] : "";
$stat = $dbh->prepare("select * from library where id=?");
$stat->bindParam(1, $id);
$stat->execute();
$row = $stat->fetch();
header('Content-Type:'.$row['mime']);
echo $row['data'];


?>
