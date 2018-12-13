<?php
	include 'auth.php';
	include 'datacontrollers/dbconnector.php';
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UCloud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="stylesheetBlock12.css" />
</head>
<body>
    <h1>Welkom bij *UCloud*</h1>
    <img src="Images/ucloud.png" alt="ucloud">
	
	<p class="form">
		<form method="POST" action="Upload_image.php" enctype="multipart/form-data">
			<div class="row">
				<input type="file" name="image">
			</div>
			<div class="row">
				<input type="submit" name="submit" value="Submit">
			</div>
			
		</form>
	</p>
	
<br/>

<?php
	// Create connection
	$dsn ="mysql:host=$servername;dbname=$dbname;";
	$db = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
	$stat = $db->prepare("SELECT * FROM images WHERE user_id=?");
	$stat->bindParam(1, $user_id);
	$stat->execute();
    while ($row = $stat->fetch()) {
	echo "<div class='gallery'>";
		echo "<img src=display_image.php?id=".$row['id']." alt=".$row['name'].">";
		echo "<br\>";
		echo "<div class='desc'>";
			echo "<input type=\"submit\" value=\"Delete image\">";
		echo "</div>";
	echo "</div>";
    }
?>

</body>