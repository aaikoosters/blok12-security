<?php
$servername = "127.0.0.1";
$username = "root";
$password = "JkCzA1eXa4NBxFwRDnPLbGykHS2KzXSbD9JMZIrrVDlUhat058rHu6RVVLqpMDEWltKnnbdRK9QFf9JE7RvoJjDSDTD05i1U9oVMckW0cdz2vS9L8jbV6hRcKVHA4akSsCY8zYRy4iLsNGEYD9XD1NSdy0GBvuRCHv5TPbwE7uEvNyAOazMr0DaDhYduNnl8HkbTEhhm37mMeaWBvDNVtUdmNXOmJ8Ka9fILwUsiLaHdQiO3HHdyhz8Zf0388exo";
$dbname = "blok12db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection

$logmessage = "database connected";
	include 'super secret logging file.php';

?>