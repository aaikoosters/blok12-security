<?php
session_start();
if (isset($_SESSION['token']))
{
$oldtoken = $_SESSION['token'];
include 'datacontrollers/dbconnector.php';
$user_id = null;
//haal sessie op
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT id, user_id, expiration FROM sessions WHERE sessiontoken = ?");
    $stmt->execute([$oldtoken]);

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    //print_r($stmt->fetchall());
	foreach($stmt->fetchall() as $array)
	{
		if(new DateTime($array["expiration"]) > new DateTime("now"))
		{
			
			$session_id = $array["id"];
			$user_id = $array["user_id"];
			$sql ="UPDATE sessions SET expiration=? WHERE id= ?";
			$stmt= $conn->prepare($sql);
			$stmt->execute([date("Y-m-d H:i:s", strtotime('+ 5 minute')), $session_id]);
		}
		else
		{
			$logmessage = "expired session";
	include 'super secret logging file.php';
		}
	}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
	$logmessage = "authenticated";
	include 'super secret logging file.php';
if(!$user_id)
{
	header('Location: secondpage.php');
}

//creer nieuw sessie token

//sla niew sessie token op

// redirect naar login als t fout gaat
}
else
{
	header('Location: secondpage.php');
}
?>