
<?php
require_once "FPDF/fpdf.php";
require_once "config.php";

session_start();
$userId = $_SESSION['userid'];
$username = $_SESSION['username'];


$gn = "SELECT GramaNiladhariId FROM user WHERE userId=$userId";
if ($result_gnId = mysqli_query($link, $gn)) {
    if (mysqli_num_rows($result_gnId) > 0) {
        $res = mysqli_fetch_array($result_gnId);
        $gnId = $res['GramaNiladhariId'];
    }
}


$qertyshow = "SELECT h.householdMemberId, h.memberFirstName, h.memberLastName, h.NIC, h.DOB,h.genderId, g.gender,
 h.Relationship, e.employmentType, h.employementTypeId,h.employementDescription, h.income, h.statusId,s.status,
 h.userId, h.gramaNiladhariId FROM (((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
    INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId) INNER JOIN status AS s
    ON s.statusId=h.statusId)
    WHERE h.gramaNiladhariId='$gnId' AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=9)";
$data= mysqli_query($link, $qertyshow);
if(isset($_POST['btn_download'])){
    //echo "Working";
    $pdf=new FPDF('P','mm','A4');
    $pdf->SetFont('Arial','B',8);
    $pdf->AddPage();

    $pdf->Cell(14,10,'Mem_No.',1,0,'C');
    $pdf->Cell(20,10,'First Name',1,0,'C');
    $pdf->Cell(20,10,'Last Name',1,0,'C');
    $pdf->Cell(20,10,'NIC',1,0,'C');
    $pdf->Cell(18,10,'DOB',1,0,'C');
    $pdf->Cell(12,10,'Gender',1,0,'C');
    $pdf->Cell(20,10,'Relationship',1,0,'C');
    $pdf->Cell(21,10,'Emp. Type',1,0,'C');
    $pdf->Cell(28,10,'Employment',1,0,'C');
    $pdf->Cell(20,10,'Income',1,1,'C');
    //$pdf->Cell(10,10,'Status',1,1,'C');

    $pdf->SetFont('Arial','',8);
while($row=mysqli_fetch_assoc($data)){
    $pdf->Cell(14,10,$row['householdMemberId'],1,0,'C');
    $pdf->Cell(20,10,$row['memberFirstName'],1,0,'C');
    $pdf->Cell(20,10,$row['memberLastName'],1,0,'C');
    $pdf->Cell(20,10,$row['NIC'],1,0,'C');
    $pdf->Cell(18,10,$row['DOB'],1,0,'C');
    $pdf->Cell(12,10,$row['gender'],1,0,'C');
    $pdf->Cell(20,10,$row['Relationship'],1,0,'C');
    $pdf->Cell(21,10,$row['employmentType'],1,0,'C');
    $pdf->Cell(28,10,$row['employementDescription'],1,0,'C');
    $pdf->Cell(20,10,$row['income'],1,1,'C');
    //$pdf->Cell(10,10,$row['status'],1,1,'C');
}

    $pdf->Output();

}
    /*
header("Content-Type: application/octet-stream");
  
//$file = $_GET["GNDataTable.php"]  . ".pdf";
  
//header("Content-Disposition: attachment; filename=" . urlencode($file));   

 header('Content-disposition: attachment; filename=GNDataTable.pdf');
 header('Content-type: application/download');
 header("Content-Description: File Transfer");            
 header("Content-Length: " . filesize(GNDataTable.php));
 //readfile('GNDataTable.pdf');

 flush(); // This doesn't really matter.
  
$fp = fopen(GNDataTable.php, "r");
while (!feof($fp)) {
    echo fread($fp, 65536);
    flush(); // This is essential for large downloads
} 
  
fclose($fp); 

*/

 ?>