<!doctype html>
<html lang="en">
  <head>
    <title>GramaNiladhari Home</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    <link rel="stylesheet" href="css/custom.css">
    
    <style type="text/css">
    #t01 th {
            background-color: black;
            color: white;
        }
</style>
  </head>

  <body>
  <div class="container-fluid">
			<section>
				<div class="row">
					<div class="col-sm-7" style="background-color: rgb(95, 143, 103);font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                        <h1>E-Census Sri Lanka</h1>
                    </div>

                    <div class="col-sm-1" style="background-color: rgb(95, 143, 103);">
                        <i class="fa fa-bell" style="font-size:36px; margin-top:24px; float:right;"><a href="logout.php">out</a></i>

                    </div>
                    <?php

?>
                    <div class="col-sm-3" style="background-color: rgb(95, 143, 103);">
                        <label style="margin-top:30px; float:right;"><h5> <?php session_start();
$userId = $_SESSION['userid'];
$username = $_SESSION['username'];
echo $username?></h5></label>
					</div>
                    <div class="col-sm-1" style="background-color: rgb(95, 143, 103);">
                        <i class='far fa-user-circle' style='font-size:36px; float: right;margin-top:30px;'></i>
					</div>
                </div>

            </section>

        <div style="background-image:url('images/bckedit.png'); height: 610px; width:1560px;">

<?php 
require_once "config.php";
session_start(); 
$userId=$_SESSION['userid'];                
$username=$_SESSION['username'];

$gn="SELECT GramaNiladhariId FROM user WHERE userId=$userId";
if($result_gnId=mysqli_query($link,$gn)){
    if(mysqli_num_rows($result_gnId)>0){
        $res=mysqli_fetch_array($result_gnId);
        $gnId=$res['GramaNiladhariId'];
    }
}


//$id = $_GET['id'];

//if(isset($_POST['Edit']))
if(isset($_POST['view'])){
    $qertyshow = "SELECT h.householdMemberId, h.memberFirstName, h.memberLastName, h.NIC, h.DOB,h.genderId, g.gender,
 h.Relationship, e.employmentType, h.employementTypeId,h.employementDescription, h.income, h.statusId,s.status,
 h.userId, h.gramaNiladhariId FROM (((history AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
    INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId) INNER JOIN status AS s 
    ON s.statusId=h.statusId)
    WHERE h.gramaNiladhariId='135'";//'$gnId135'

    if($result_history=mysqli_query($link,$qertyshow)){
        if(mysqli_num_rows($result_history)>0){
            //echo "after";
            echo "<table id='t02'>";
            echo "<thead >";
            echo "<tr>";
            echo "<th>Member No.</th>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>NIC</th>";
            echo "<th>DOB</th>";
            echo "<th>Gender</th>";
            echo "<th>Relationship</th>";
            echo "<th>EmploymentType</th>";
            echo "<th>Employement Desc</th>";
            echo "<th>Income</th>";
            echo "<th>Status</th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "</tr>";
            echo "</thead>";

            echo "<tbody>";

            while($hh=mysqli_fetch_array($result_history)){
                echo "<td>".$hh['householdMemberId']."</td>";
                            //echo "<td>".$hh['householdMemberId']."</td>";
                echo "<td>".$hh['memberFirstName']."</td>";
                echo "<td>".$hh['memberLastName']."</td>";
                echo "<td>".$hh['NIC']."</td>";
                echo "<td>".$hh['DOB']."</td>";
                echo "<td><select name='gender'>
                                <option value=".$hh['genderId'].">".$hh['gender']."</option>
                                </select></td>";
                            //echo "<td><input type='text' name='gender' size='6' value='".$hh['gender']."'></td>";
                echo "<td>".$hh['Relationship']."</td>";
                echo "<td>".$hh['employmentType']."</td>";
                            //echo "<td><input type='text' name='employmentType' size='10' value='".$hh['employmentType']."'</td>";
                echo "<td>".$hh['employementDescription']."</td>";
                echo "<td>".$hh['income']."</td>";
                            //echo "<td><input type='text' name='gramaNiladhariId' size='5' value='".$hh['gramaNiladhariId']."'</td>";
                echo "<td>".$hh['status']."</td>";
                echo "<td><form action='approval.php' method='post'><INPUT TYPE ='Submit' Name = 'approve' VALUE = 'APPROVE'></form></td>";
                echo "<td><form action='approval.php' method='post'><INPUT TYPE ='Submit' Name = 'reject' VALUE = 'REJECT'></form></td>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    }
                    else{
                        echo "No record is matching your query";
                    }
                }	
                else{
                    "ERROR:Could not able to execute $history ".mysqli_error($link);
                }
	
    } 


    //approving the row
    if(isset($_POST['approve'])){
        $update="UPDATE householdmember SET statusId=5
WHERE householdMemberId = '$_POST[householdMemberId]'";

if(mysqli_query($link,$update)){
	
	echo "Approved"; 
    header("refresh:0; url=GNApproval.php");
	}
	else{
		echo "Not Updated.";
	}
}   

if(isset($_POST['reject'])){
    $update="UPDATE householdmember SET statusId=9
WHERE householdMemberId = '$_POST[householdMemberId]'";

if(mysqli_query($link,$update)){

echo "Rejected"; 
header("refresh:0; url=GNApproval.php");
}
else{
    echo "Not Updated.";
    }
}   
   

?>
</div>
</body>

</html>