<?php 	
	if (!isset($database))
	{  
		//echo "<p>Connecting to db server...\n</p>";
		
		$user="root";
		$password="root";
		$dbname="mydb";
		$database = mysqli_connect("localhost",$user,$password,$dbname);
		
		if (!$database) 
		{
			die("<p>Could not connect to db server: " . mysqli_error($database) . "\n</p>");
		}
	}
?>
