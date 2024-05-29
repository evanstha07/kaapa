<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "adminpanel";

$conn = mysqli_connect($host, $username, $password, $dbname);

//check connection

if(!$conn)
{
	die();
}

?>