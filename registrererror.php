
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
    <h1>Registreer bij</h1>
	<img src="Images/ucloud.png" alt="ucloud">
	<h4> 
		<?php	
		session_start();
		$foutmelding = $_SESSION['fout'];
		echo name($foutmelding);
		?>
	<h4>
		<p class="form">
			<form action="register.php" method="POST">
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
					<div class="col-40">
						<label for="Wachtwoord">Wachtwoord opnieuw:</label>
					</div>
					<div class="col-60">
						<input type="password" name="password2" placeholder="Vul hier uw wachtwoord opnieuw in">
					</div>
				</div>
				
				<div class="row">
					<input type="submit" value="Submit">
				</div>
			</form> 
		</p>
    <a href="index.html" class="myButton">Terug naar login</a>
</body>
</html>

<?php
function name($foutmelding)
{
    switch ($foutmelding){
    case "wachtwoord te kort":
    return "Password must contain one number and must be longer than 8 characters";
    break;
    case "user name bestaat":
    return "This user name is already taken.";
    break;
    case "no match / empty":
    return "The password field is empty or are not matching";
    break;
    }
}
?>