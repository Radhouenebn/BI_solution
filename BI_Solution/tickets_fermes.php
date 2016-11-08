<?php 
include ('session2.php');
              if ($user == "all")
              		{if ($graph != "period")
              		include 'script_1.php';
              		else 
              			include 'script_period_per_user.php';
              	}
              	else
              		include 'script_per_period_1.php';
              
?>