<?php
SESSION_START();
$oldSessionToken = $_SESSION['token'];
$newSessionToken = generateRandomString(30);
$_SESSION['token'] = $newSessionToken;



function generateRandomString($length){ 
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $charsLength = strlen($characters) -1;
    $string = "";
    for($i=0; $i<$length; $i++){
        $randNum = mt_rand(0, $charsLength);
        $string .= $characters[$randNum];
    }
    return $string;
}

?>