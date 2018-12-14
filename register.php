<?php
$un = $_POST['username'];
$pwtry = $_POST['password'];
$pwtry2 = $_POST['password2'];
$alreadyinuse = false;

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
		if(!$alreadyinuse){
			$logmessage = "registration succesfull, username: ". $un;
			$sql = "INSERT INTO users (un, pw) VALUES (?,?)";
			$stmt= $conn->prepare($sql);
			$stmt->execute([$un, password_hash("$pwtry", PASSWORD_BCRYPT, ['cost' => 12])]);
			
			//echo "New record created successfully";
			header('Location: index.html');
		}else{
			$logmessage = "This user name is already taken, username: ". $un;
			echo "This user name is already taken. <br/>";
			header('Location: registernewuser.html');
		}
	} else{
		$logmessage = "The password field is empty or are not matching, username: ". $un;
		echo "The password field is empty or are not matching. <br/>";
		header('Location: registernewuser.html');
	}
}catch(PDOException $e){
    echo "<br>" . $e->getMessage();
}
$conn = null;
			
	include 'super secret logging file.php';
?>