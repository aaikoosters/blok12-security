<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UCloud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="stylesheetBlock12.css" />
</head>
<body>
    <h1>Welkom bij </h1>
    <img src="Images/ucloud.png" alt="ucloud">
    <h4> 
		<?php	
		session_start();
		if(isset($_SESSION['block']))
		{
		$foutmelding = $_SESSION['block'];
		echo names($foutmelding);
		}
		?>
	<h4>
    <h2>
        <?php
        echo name();
        ?> try again!</h2>
	<p class="form">
		<form action="loginhandeler.php" method="POST">
			<div class="row">
				<div class="col-40">
					<label for="Inlogname">Inlogname:</label>
				</div>
				<div class="col-60">
					<input type="text" name="username" placeholder="Vul hier uw username in">
				</div>
			</div>
			
			<div class="row">
				<div class="col-40">
					<label for="Wachtwoord">Wachtwoord:</label>
				</div>
				<div class="col-60">
					<input type="password" name="password" placeholder="Vul hier uw wachtwoord in">
				</div>
			</div>
			
			<div class="row">
				<input type="submit" value="Submit">
			</div>
		</form> 
	</p>
    <a href="registernewuser.html" class="myButton">Registreer</a>
</body>
</html>

<?php
function name()
{
    switch (rand(1, 3)){
    case 1:
    return "LOSER";
    break;
    case 2:
    return "DEBIEL";
    case 3:
    return "INBREKER";
    break;
    }
}

function names($foutmelding)
{
    switch ($foutmelding){
    case "block":
    return "You have been blocked for 5 minute";
    break;
    }
}
?>