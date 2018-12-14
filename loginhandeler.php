<?php
$un = $_POST['username'];
$pwtry = $_POST['password'];
$realpw = null;
//$block = FALSE;

session_start();

include 'datacontrollers/dbconnector.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT pw, attempt FROM users WHERE un = ?"); 
    $stmt->execute([$un]);

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    //print_r($stmt->fetchall());
	foreach($stmt->fetchall() as $array)
	{
			$realpw = $array["pw"];
			$status = $array['attempt'];
	}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$realid = null;


if(!isset($block)){

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

		$sql = "INSERT INTO sessions (user_id, sessiontoken, expired, time, expiration) VALUES (?,?,?,?,?)";
		$stmt= $conn->prepare($sql);
<<<<<<< HEAD
		$stmt->execute([$realid, $newsessiontoken, '0', date("Y-m-d H:i:s"), date("Y-m-d H:i:s", strtotime('+ 5 minute'))]);
=======
		$stmt->execute([$realid, $newsessiontoken, '0', date("Y-m-d H:i:s")]);

		$sql ="UPDATE users SET attempt='' WHERE un= ?";
		$stmt= $conn->prepare($sql);
		$stmt->execute([$un]);
>>>>>>> origin/develop
		
		//echo "New record created successfully";
		$_SESSION['token'] = $newsessiontoken;
		header('Location: index.html');
	}
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	$conn = null;
	$logmessage = "loged in, username: ". $un;
	include 'super secret logging file.php';
    header('Location: portal.php');
}
else
{

	if($status == ""){
		// User was not logged in before
		$sql ="UPDATE users SET attempt='1' WHERE un= ?";
		$stmt= $conn->prepare($sql);
		$stmt->execute([$un]);

	}else if($status == 5){
		// 5 min time out
		$stort =  strtotime("+5 minutes", time());
		$sql ="UPDATE users SET attempt= 'b-$stort'  WHERE un= ?";
		$stmt= $conn->prepare($sql);
		$stmt->execute([$un]);
	}else if(substr($status, 0, 2) == "b-"){
		// Account blocked
		$blockedTime = substr($status, 2);
		if(time() < $blockedTime){
		   $block = true;
		}else{
		   // remove the block, because the time limit is over
		   $sql ="UPDATE users SET attempt= '1' WHERE un= ?";
		   $stmt= $conn->prepare($sql);
		   $stmt->execute([$un]);
		}
	}else if($status < 5){     // If the attempts are less than 5 and not 5     
		$sql ="UPDATE users SET attempt= $status + 1 WHERE un= ?";
		$stmt= $conn->prepare($sql);
		$stmt->execute([$un]);
	}
	
	$logmessage = "login not succesfull, username: ". $un;
	include 'super secret logging file.php';
    header('Location: secondpage.php');
}
}
?>