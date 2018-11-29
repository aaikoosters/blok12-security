<?php
session_start();
$oldtoken = $_SESSION["token"];
$_SESSION["token"] = rand(min, max);
?>