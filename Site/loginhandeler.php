<?php

$hcun = 1;
$hcpw = 2;
SESSION_START();
$username = $_POST['username'];
$password = $_POST['password'];

if ($username == $hcun)
{
    if ($password == $hcpw)
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