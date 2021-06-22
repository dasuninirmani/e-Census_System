<?php

require_once "config.php";
session_start(); 
$userId=$_SESSION['userid'];                
$username=$_SESSION['username']; 
$id = $_GET['id'];

//$del = mysqli_query($link,"delete from householdmember where householdMemberId = '$id'");
$del = mysqli_query($link,"UPDATE householdmember SET statusId = 1 where householdMemberId = '$id'");


if($del)
{
    mysqli_close($link); // Close connection
    header("location:hhhomeinterface.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>