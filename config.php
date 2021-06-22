<?php
$dbServerName="localhost";
$dbUserName="root";
$dbPassword="";
$dbName="ecensus";


$link=mysqli_connect($dbServerName,  $dbUserName, $dbPassword, $dbName);
if($link===false){
	die("ERROR:Couldn't connect, ". mysqli_connect_error());
	
	
}


?>