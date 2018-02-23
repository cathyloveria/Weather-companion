<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '');
if (!$conn){
	die("Database Connection Failed" . mysqli_error());
}
$login_db = mysqli_select_db($conn,'tbl_user');
if (!$login_db){
	die("Database Selection Failed" . mysqli_error());
}
#echo 'Connected successfully';

?>