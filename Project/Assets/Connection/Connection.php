<?php 
$server = "localhost";
$username = "root";
$password = "";
$db = "db_leavedesk";


$conn = mysqli_connect($server, $username, $password, $db);
if(!$conn)
{
	
	echo "Conenction Faild";
	
	}



?>