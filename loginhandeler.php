<?php
$un = $_POST['username'];
$pwtry = $_POST['password'];
$realpw = null;

session_start();

include 'datacontrollers/dbconnector.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT pw FROM users WHERE un = ?"); 
    $stmt->execute([$un]);

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    //print_r($stmt->fetchall());
	foreach($stmt->fetchall() as $array)
	{
			$realpw = $array["pw"];
	}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$realid = null;

if (password_verify($pwtry, $realpw))
{
	$newsessiontoken = password_hash(rand(0, 10000000), PASSWORD_BCRYPT, ['cost' => 12]);
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
			$realid = $array["id"];
		}

		$sql = "INSERT INTO sessions (user_id, sessiontoken, expired, time) VALUES (?,?,?,?)";
		$stmt= $conn->prepare($sql);
		$stmt->execute([$realid, $newsessiontoken, '0', date("Y-m-d H:i:s")]);
		
		//echo "New record created successfully";
		$_SESSION['token'] = $newsessiontoken;
		header('Location: index.html');
	}
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	$conn = null;
    header('Location: portal.php');
}
else
{
	$conn = null;
    header('Location: secondpage.php');
}
?>