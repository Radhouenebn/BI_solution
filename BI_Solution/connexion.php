<?php
		$servername="localhost";
		$username="root";
		$password="";
		$database="Sifast_itop";
		$conn;
	function Connect()
	{
		global $servername,$username,$password,$database,$conn;
		$conn = mysql_connect($servername,$username,$password);
        $db = mysql_select_db($database);
    }
    
    function Disconnect()
    {
    	global $conn;
    	mysql_close($conn);
    }
?>