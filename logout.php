<?php
	include 'datacontrollers/dbconnector.php';
	include 'auth.php';
	$dsn ="mysql:host=$servername;dbname=$dbname;";
	$db = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	$sql ="UPDATE sessions SET expiration=? WHERE id= ?";
	$stmt= $db->prepare($sql);
	$stmt->execute([date("Y-m-d H:i:s"), $session_id]);

	$logmessage = "loged out";
	include 'super secret logging file.php';
    header('Location: portal.php');
	?>