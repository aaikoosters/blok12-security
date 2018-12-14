<?php
$un = $_POST['username'];
$pwtry = $_POST['password'];
$pwtry2 = $_POST['password2'];
$alreadyinuse = false;

session_start();
$_SESSION['fout'] = null;

include 'datacontrollers/dbconnector.php';

try {
	if((!empty($pwtry) || !empty($pwtry2)) && $pwtry2 == $pwtry){
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$stmt = $conn->prepare("SELECT id FROM users WHERE un = ?"); 
		$stmt->execute([$un]);

		// set the resulting array to associative
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
		//print_r($stmt->fetchall());
		foreach($stmt->fetchall() as $array){
			$alreadyinuse = true;
		}

		if(strlen($pwtry) < 8 || !preg_match("#[0-9]+#", $pwtry) || !preg_match("#[a-zA-Z]+#", $pwtry)){
			$_SESSION['fout'] = "wachtwoord te kort";
			header('Location: registererror.php');
		}
		elseif(!$alreadyinuse){
			$logmessage = "registration succesfull, username: ". $un;
			$sql = "INSERT INTO users (un, pw) VALUES (?,?)";
			$stmt= $conn->prepare($sql);
			$stmt->execute([$un, password_hash("$pwtry", PASSWORD_BCRYPT, ['cost' => 12])]);
			
			//echo "New record created successfully";
			header('Location: index.html');
		}else{
			$logmessage = "This user name is already taken, username: ". $un;
			$_SESSION['fout'] = "user name bestaat";
			header('Location: registererror.php');
		}
	} else{
		$logmessage = "The password field is empty or are not matching, username: ". $un;
		$_SESSION['fout'] = "no match / empty";
		header('Location: registererror.php');
	}
}catch(PDOException $e){
    echo "<br>" . $e->getMessage();
}
$conn = null;
			
	include 'super secret logging file.php';
?>