<?php
ob_start();
session_start();
// error_reporting(0);
require 'Config.php';
require '../vendor/autoload.php';
//setlocale(LC_ALL, 'en_US.UTF-8');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

	$lead_status = $_SESSION['lead_status'];
	$Sales_name = $_SESSION['Sales_name']; 
	$month = $_SESSION['month'];

$sql="select s.S_Name, s.salesid, c.custid, c.name, c.surname, c.phone, c.email, l.product, i.I_Status, datename(mm, L.Date_Created) as 'Date'
from Sales_Rep s, Customer c, Lead l, Invoice i, Product p, AssignTask a
where a.SalesID = s.SalesID
AND c.CustID = l.CustID
AND l.Prod_ID = p.Prod_ID
AND l.LeadID = i.Lead_ID
AND datename(mm, a.stMonth) = datename(mm, l.Date_Created)
AND i.I_Status = '".$_SESSION['month']."'
AND a.SalesID = '".$_SESSION['month']."'
AND datename(mm, a.stMonth) = '".$_SESSION['month']."'
Group by s.S_Name, s.salesid, c.custid, c.name, c.surname, c.phone, c.email, l.product, i.I_Status, l.Date_Created";
$stmt=sqlsrv_query($conn, $sql);
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$i=1;
			$sheet->setCellValue('A'.$i, 'S_Name');
			$sheet->setCellValue('B'.$i, 'salesid');
			$sheet->setCellValue('C'.$i, 'custid');
			$sheet->setCellValue('D'.$i, 'name');
			$sheet->setCellValue('E'.$i, 'surname');
			$sheet->setCellValue('F'.$i, 'phone');
			$sheet->setCellValue('G'.$i, 'email');
			$sheet->setCellValue('H'.$i, 'product');
			$sheet->setCellValue('I'.$i, 'I_Status');
			$sheet->setCellValue('J'.$i, 'Date');
			
			$i++;
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
		{
			$sheet->setCellValue('A'.$i, $row['S_Name']);
			$sheet->setCellValue('B'.$i, $row['salesid']);
			$sheet->setCellValue('C'.$i, $row['custid']);
			$sheet->setCellValue('D'.$i, $row['name']);
			$sheet->setCellValue('E'.$i, $row['surname']);
			$sheet->setCellValue('F'.$i, $row['phone']);
			$sheet->setCellValue('G'.$i, $row['email']);
			$sheet->setCellValue('H'.$i, $row['product']);
			$sheet->setCellValue('I'.$i, $row['I_Status']);
			$sheet->setCellValue('J'.$i, $row['Date']);
			
			$i++;
			
		}
		$writer = new Xlsx($spreadsheet);
//$writer->save('hello world.xlsx');

$temp_file = tempnam(sys_get_temp_dir(), 'PHPLead');
$writer->save($temp_file);

function read_and_delete_first_line($filename) {
  $file = file($filename);
  $output = $file[0];
  unset($file[0]);
  file_put_contents($filename, $file);
  return $output;
}
//read_and_delete_first_line($temp_file);

 $name="leads ".date("F j Y").".xlsx";
        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header('Content-Type: application/vnd.ms-excel');
        header ( "Content-Disposition: attachment; filename=".$name);
       	readfile($temp_file);?>