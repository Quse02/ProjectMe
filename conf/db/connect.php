<?php
// WE ARE NOT USING THIS!!!
session_start();

$DB_host = "localhost";
$DB_user = "shaunqua_sqadmin";
$DB_pass = "Mvccocc23";
$DB_name = "shaunqua_showcase";

try
{
	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}


include_once '../application/classes/dbh.php';
$user = new USER($DB_con);

$password = "123456";
$hash = password_hash($passwod, PASSWORD_DEFAULT);
$hashed_password = "$2y$10$BBCpJxgPa8K.iw9ZporxzuW2Lt478RPUV/JFvKRHKzJhIwGhd1tpa";

/*
"123456" will become "$2y$10$BBCpJxgPa8K.iw9ZporxzuW2Lt478RPUV/JFvKRHKzJhIwGhd1tpa"
*/ 

