<?php

$hcpw = password_hash("2", PASSWORD_BCRYPT, ['cost' => 12]); //12 is cost, 2 is pw

$hcun = 1;

SESSION_START();
$username = $_POST['username'];
$password = $_POST['password'];

if ($username == $hcun)
{
    if (password_verify($password, $hcpw))
    {
        header('Location: portal.html');
    }
    else
    {
        header('Location: secondpage.html');
    }
}
else
{
    header('Location: secondpage.html');
}
?>