<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "JkCzA1eXa4NBxFwRDnPLbGykHS2KzXSbD9JMZIrrVDlUhat058rHu6RVVLqpMDEWltKnnbdRK9QFf9JE7RvoJjDSDTD05i1U9oVMckW0cdz2vS9L8jbV6hRcKVHA4akSsCY8zYRy4iLsNGEYD9XD1NSdy0GBvuRCHv5TPbwE7uEvNyAOazMr0DaDhYduNnl8HkbTEhhm37mMeaWBvDNVtUdmNXOmJ8Ka9fILwUsiLaHdQiO3HHdyhz8Zf0388exo";
$dbname = "blok12db";

$dsn ="mysql:host=$servername;dbname=$dbname;";
$db = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		

$id = isset($_GET['id'])? $_GET['id'] : "";
$stat = $db->prepare("select * from images where id=?");
$stat->bindParam(1, $id);
$stat->execute();

$row = $stat->fetch();

header("Content-Type:".$row['mimi']);
echo $row['image'];
?>