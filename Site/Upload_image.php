<?php
	// If upload button is clicked ...
	if (isset($_POST['upload'])) {
		// Create database connection
		$servername = "127.0.0.1:3307";
		$username = "root";
		$password = "JkCzA1eXa4NBxFwRDnPLbGykHS2KzXSbD9JMZIrrVDlUhat058rHu6RVVLqpMDEWltKnnbdRK9QFf9JE7RvoJjDSDTD05i1U9oVMckW0cdz2vS9L8jbV6hRcKVHA4akSsCY8zYRy4iLsNGEYD9XD1NSdy0GBvuRCHv5TPbwE7uEvNyAOazMr0DaDhYduNnl8HkbTEhhm37mMeaWBvDNVtUdmNXOmJ8Ka9fILwUsiLaHdQiO3HHdyhz8Zf0388exo";
		$dbname = "blok12db";

		// Create connection
		$dsn ="mysql:host=$servername;dbname=$dbname;";
		$db = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		$check = getimagesize($_FILES["image"]["tmp_name"]);
		if($check !== false){
			$userId = 1;
			$name = $_FILES['image']['name'];
			$mimi = $_FILES['image']['type'];
			$data = file_get_contents($_FILES['image']['tmp_name']);
			$stmt = $db->prepare("INSERT INTO images VALUES('', ?, ?, ?, ?)");
			$stmt->bindParam(1, $userId);
			$stmt->bindParam(2, $name);
			$stmt->bindParam(3, $mimi);
			$stmt->bindParam(4, $data);
			$stmt->execute();
			
			if (!$stmt) {
				echo "\nPDO::errorInfo():\n";
				print_r($db->errorInfo());
			}
			
			echo "\nPDO::errorInfo():\n";
				print_r($db->errorInfo());
		}
	}
    header('Location: portal.php');
?>