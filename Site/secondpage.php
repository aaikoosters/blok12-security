<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UCloud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <style>
body {
    background-color: linen;
    text-align: center;
    margin-top: 50px;
}

h1 {
    color: maroon;
    margin-left: 40px;
}
form {
    text-align: center;
}

        </style>
</head>
<body>
    <h1>Welkom bij *UCloud*</h1>
    <h2>
        <?php
        echo name();
        ?> try again!</h2>
    <img src="/Images/ucloud.png" alt="ucloud">
    <p class="form">
        <form action="/loginhandeler.php" method="POST">
            inlogname:<br>
            <input type="text" name="username" placeholder="Vul hier uw username in">
            <br>
            wachtwoord:<br>
            <input type="password" name="password" placeholder="Vul hier uw wachtwoord in">
            <br><br>
            <input type="submit" value="Submit">
        </form> 
    </p>
      <a href="registernewuser.html">registreer</a>
</body>
</html>

<?php
function name()
{
    switch (rand(1, 10)){
    case 1:
    return "LUL";
    break;
    case 2:
    return "HOER";
    break;
    case 3:
    return "LOSER";
    break;
    case 4:
    return "DEBIEL";
    break;
    case 5:
    return "KUT";
    break;
    case 6:
    return "BIER";
    break;
    case 7:
    return "SLET";
    break;
    case 8:
    return "PROSTITUE";
    break;
    case 9:
    return "DORST?";
    break;
    case 10:
    return "INBREKER";
    break;
    }
}
?>