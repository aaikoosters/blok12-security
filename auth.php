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
    $stmt = $conn->prepare("SELECT id, user_id, time FROM sessions WHERE sessiontoken = ? AND expired = 0");
    $stmt->execute([$oldtoken]);

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    //print_r($stmt->fetchall());
	foreach($stmt->fetchall() as $array)
	{
		//if($array["time"] >= $date->modify('-1 day');)
		//{
			
			$session_id = $array["id"];
			$user_id = $array["user_id"];
		//}
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