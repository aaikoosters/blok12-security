<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UCloud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="/stylesheetBlock12.css" />
</head>
<body>
    <h1>Welkom bij *UCloud*</h1>
    <img src="/Images/ucloud.png" alt="ucloud">
	
	<p class="form">
		<form method="POST" action="/Upload_image.php" enctype="multipart/form-data">
			<div class="row">
				<input type="file" name="image">
			</div>

			<br/>
					
			<div class="row">
				<input type="submit" value="Submit">
			</div>
			
		</form>
	</p>
	
<br/>


<?php
	$servername = "127.0.0.1:3307";
	$username = "root";
	$password = "JkCzA1eXa4NBxFwRDnPLbGykHS2KzXSbD9JMZIrrVDlUhat058rHu6RVVLqpMDEWltKnnbdRK9QFf9JE7RvoJjDSDTD05i1U9oVMckW0cdz2vS9L8jbV6hRcKVHA4akSsCY8zYRy4iLsNGEYD9XD1NSdy0GBvuRCHv5TPbwE7uEvNyAOazMr0DaDhYduNnl8HkbTEhhm37mMeaWBvDNVtUdmNXOmJ8Ka9fILwUsiLaHdQiO3HHdyhz8Zf0388exo";
	$dbname = "blok12db";

	// Create connection
	$dsn ="mysql:host=$servername;dbname=$dbname;";
	$db = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
	$stat = $db->prepare("SELECT * FROM images");
	$stat->execute();
    while ($row = $stat->fetch()) {
      echo "<div class='gallery'>";
      	echo "<img src=display_image.php?id=".$row['id']." alt=".$row['name'].">";
      echo "<br/>";
		echo "<input type=\"submit\" value=\"Delete image\">";
      echo "</div>";
    }
?>

</body>