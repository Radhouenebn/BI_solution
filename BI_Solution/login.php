<?php
session_start();
if (isset($_POST['commit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
//echo "Username or Password is invalid";
echo '<script type="text/javascript">';
echo 'alert("Empty fields");';
echo '</script>';
header('Location: index.php'); 
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost","root","");
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
// Selecting Database
$db = mysql_select_db("phpmyadmin");
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from users where password='$password' AND login='$username'");
$rows = mysql_fetch_array($query);
if ($rows['login'] == $username && $rows['password'] == $password) {
//alert("Login successful");
$_SESSION['login_user']=$username;
echo '<script type="text/javascript">';
echo 'alert(\'Login successfully\')';
echo '</script>';
header('Location:home.php');  
} else {
//alert("Username Or password is Invalid");
echo '<script language="javascript">';
echo 'alert("username or password false ! try again")';
echo '</script>';
header('Location: index.php'); 
}
mysql_close($connection); // Closing Connection
}
}
?>
