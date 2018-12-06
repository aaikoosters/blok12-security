<?php
include 'datacontrollers/dbconnector.php';
include 'auth.php';

$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$idImage = isset($_GET['id'])? $_GET['id'] : "";
$stat = $db->prepare("select * from images where id=? and user_id=?");
$stat->bindParam(1, $idImage);
$stat->bindParam(2, $user_id);
$stat->execute();

$row = $stat->fetch();

header("Content-Type:".$row['mimi']);
echo $row['image'];
?>