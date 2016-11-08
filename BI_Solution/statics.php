<?php
$ses2=session_start();
$_SESSION['user']=$_POST['user'];
$_SESSION['team']=$_POST['team'];
$_SESSION['agent']=$_POST['agent'];
$_SESSION['date_min']=$_POST['date_min'];
$_SESSION['date_max']=$_POST['date_max'];
$_SESSION['graph']=$_POST['graph'];

    header('Location: statistiques.php');
?>
