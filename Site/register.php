<?php
$un = $_POST['username'];
$pwtry = $_POST['password'];
$alreadyinuse = false;

include 'datacontrollers/dbconnector.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$stmt = $conn->prepare("SELECT id FROM users WHERE un = ?"); 
    $stmt->execute([$un]);

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    //print_r($stmt->fetchall());
	foreach($stmt->fetchall() as $array)
	{
		$alreadyinuse = true;
	}
	if(!$alreadyinuse)
	{
	$sql = "INSERT INTO users (un, pw) VALUES (?,?)";
	$stmt= $conn->prepare($sql);
	$stmt->execute([$un, password_hash("$pwtry", PASSWORD_BCRYPT, ['cost' => 12])]);
	
    //echo "New record created successfully";
	header('Location: index.html');
	}
	else
	{
		echo "vage error";
	}
    }
catch(PDOException $e)
    {
    echo "<br>" . $e->getMessage();
    }
$conn = null;
?>