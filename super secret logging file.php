<?php
if (!isset($logmessage))
{
	$logmessage = null;
}
if (!isset($session_id))
{
	$token = null;
}
else
{
	$token = $session_id;
}
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO actions (url, content, session_id, time) VALUES (?, ?, ?, ?)";
		$stmt= $conn->prepare($sql);
		$stmt->execute([$url, $logmessage, $token, date("Y-m-d H:i:s")]);
		
		//echo "New record created successfully";
	}
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	$conn = null;
?>