<?php 
include ('session2.php');
              if ($agent == "all")
              		{if ($graph != "period")
              		include 'script.php';
              		else 
              			include 'script_period_per_agent.php';
              	}
              	else
              		include 'script_per_period.php';
              
?>