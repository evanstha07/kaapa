<?php
include '../dbconnect.php';
$uid = $_GET['id'];

$q = mysqli_query($conn, "DELETE FROM register where uid='$uid'");

header('location:manageUsr.php?page=manage_users');
