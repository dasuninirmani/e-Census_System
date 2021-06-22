<?php
include 'config.php';
session_start();
$user=$_SESSION['userid'];
$sql="SELECT GramaNiladhariId FROM user WHERE userId='$user'";
if($result=mysqli_query($link,$sql)){
    if(mysqli_num_rows($result) >0){
        $row=mysqli_fetch_assoc($result);
        $gnId=$row['GramaNiladhariId'];
        //$_SESSION['$gnId']=$gnId;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['Save'])){
    $gnOfficerId=$_POST['GNOfficerId'];
    $gnFirstName=$_POST['GnFName'];
    $gnLastName=$_POST['GnLName'];
    $gender=$_POST['Gender'];
    $contactNo=$_POST['ContactNo'];
    $email=$_POST['email'];
    $officialAddress=$_POST['officialAddress'];

    $query = "INSERT INTO gramaniladhariofficer (gramaNiladhariOfficerid, gramaniladhariOfficerFirstname, gramaNiladhariOfficerLastName, genderid, contactNo, gramaNiladhariId,officialAddress,email) VALUES('$gnOfficerId', '$gnFirstName', '$gnLastName','$gender','$contactNo','$gnId','$officialAddress','$email')";
    if (mysqli_query($link, $query)) {
        echo "Grama Niladhari Officer details added Successfully";
        
        
    } else {
        echo "Error gn: " . $query . "<br>";
    }
}

}
if (isset($_POST['Edit'])) {
    $gnOfficerId=$_POST['GNOfficerId'];
    $gnFName=$_POST['GnFName'];
    $gnLName=$_POST['GnLName'];
    $gender=$_POST['Gender'];
    $contactNo=$_POST['ContactNo'];
    $email=$_POST['email'];
    $address=$_POST['officialAddress'];
    $_SESSION['$gnId']=$gnId;

    $sql="UPDATE gramaniladhariofficer SET gramaniladhariOfficerid='$gnOfficerId',gramaniladhariOfficerFirstname='$gnFName',gramaNiladhariOfficerLastName='$gnLName',genderid='$gender',contactNo='$contactNo',Officialaddress='$address' WHERE gramaNiladhariId='$gnId'";
    if(mysqli_query($link,$sql)){
        echo "GN profile updated successfully!";
        header("location:GNProfile.php");
    }else{
        echo "Error gn: " . $sql . "<br>";
    }


}
?>


