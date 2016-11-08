<?php
$conn = mysql_connect("localhost","root","");
$db = mysql_select_db("phpmyadmin",$conn);
session_start();
$user_check=$_SESSION['login_user'];
$ses_sql = mysql_query("select login from users where login='$user_check'",$conn);
$row = mysql_fetch_assoc($ses_sql);
$login_session=$row['login'];
if(!isset($login_session)){
	mysql_close($conn);
	header('Location: index.php');
}
?>
