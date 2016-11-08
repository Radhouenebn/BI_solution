<?php 
include ('session2.php');
             	if ($user=="all")
             		{if ($graph == "period")
              			
              			include 'script_2.php';
              		else
              				include 'script_client.php';
              		}
              	else 
              			include 'script_user.php';
     
              
?>