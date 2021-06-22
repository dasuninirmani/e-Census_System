
<?php 
require_once "config.php";
session_start(); 
$userId=$_SESSION['userid'];                
$username=$_SESSION['username'];

//$id = $_GET['id'];

//if(isset($_POST['Edit']))
if(isset($_POST["Submit1"])){


/*
$edit = mysqli_query($link,"SELECT * FROM  householdmember WHERE householdMemberId = '$id'");

if($edit)
{
    mysqli_close($link); // Close connection
    header("location:hhhomeinterface.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error editing record"; // display error message if not delete
}
*/
//INSERT INTO Customers (CustomerName, ContactName, Address, City, PostalCode, Country)
    //SELECT SupplierName, ContactName, Address, City, PostalCode, Country FROM Suppliers;
$history="INSERT INTO history (householdMemberId,memberFirstName,memberLastName,NIC,DOB,genderId,Relationship,employementTypeId,employementDescription,income,statusId,userid,gramaNiladhariId) SELECT householdMemberId,memberFirstName,memberLastName,NIC,DOB,genderId,Relationship,employementTypeId,employementDescription,income,statusId,userid,gramaNiladhariId FROM householdmember WHERE householdMemberId = '$_POST[householdMemberId]'";
if(mysqli_query($link,$history)){
	//header("refresh:0; url=hhhomeinterface.php");
	echo "history added"; 
	}
	else{
		echo "Not Updated.";
	}
$update="UPDATE householdmember SET memberFirstName='$_POST[memberFirstName]', 
memberLastName='$_POST[memberLastName]',NIC='$_POST[NIC]',DOB='$_POST[DOB]',genderId='$_POST[gender]',
Relationship='$_POST[Relationship]',employementTypeId ='$_POST[employment]',
employementDescription='$_POST[employementDescription]',income='$_POST[income]',statusId=4,userid='$userId' 
WHERE householdMemberId = '$_POST[householdMemberId]'";

/*echo $_POST['householdMemberId'];
echo "<br>";
echo $userId;echo "<br>";
echo $_POST['memberFirstName']; echo "<br>";
echo $_POST['memberLastName'];echo "<br>";
echo $_POST['NIC'];echo "<br>";
echo $_POST['DOB'];echo "<br>";
echo $_POST['gender'];echo "<br>";
echo $_POST['Relationship'];echo "<br>";
echo $_POST['employment'];echo "<br>";
echo $_POST['employementDescription'];echo "<br>";
echo $_POST['income'];echo "<br>";
echo $_POST['statusId'];echo "<br>";
echo $_POST['gramaNiladhariId'];echo "<br>";
*/
//}
//else{
//    echo "error";
//}

if(mysqli_query($link,$update)){
	header("refresh:0; url=hhhomeinterface.php");
	echo "Updated"; 
	}
	else{
		echo "Not Updated.";
	}
}   
    
?>