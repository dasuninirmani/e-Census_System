<?php
session_start();
$userId = $_SESSION['userid'];
$username = $_SESSION['username'];

require_once "config.php";
require_once "Classes/PHPExcel.php";
/*
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$rowCount = 1;
while($row = mysql_fetch_array($result)){
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['name']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['age']);
    $rowCount++;
}
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('some_excel_file.xlsx');
*/

$html = str_get_html($table);

header('Content-Type:application/vnd.ms-excel');
header('Content-disposition:attachment;filename=sample.csv');
echo $_GET['data'];

$fp = fopen("php://output", "w");

        foreach($html->find('tr') as $element)
        {
            $td = array();
            foreach( $element->find('td') as $row)  
            {
                $td [] = $row->plaintext;
            }
            fputcsv($fp, $td);
        }


        fclose($fp);
        exit;

        
?>