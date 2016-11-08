<?php
$ses2=session_start();
$user=$_SESSION['user'];
$team=$_SESSION['team'];
$agent=$_SESSION['agent'];
$date_min= date("Y-m-d", strtotime($_SESSION['date_min']));
$date_max= date("Y-m-d", strtotime($_SESSION['date_max']));
$graph=$_SESSION['graph'];
error_reporting(0);
?>
