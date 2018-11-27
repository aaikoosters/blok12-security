<?php
$un = $_POST['username'];
$pwtry = $_POST['password'];
$realpw = null;
SESSION_START();

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
$conn = null;
if (password_verify($pwtry, $realpw))
{
    header('Location: portal.html');
}
else
{
    header('Location: secondpage.php');
}
?>