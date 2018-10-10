<?php
require 'configCookie.php';
require '../vendor/autoload.php';
//setlocale(LC_ALL, 'en_US.UTF-8');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$sql='select * from lead';
$stmt=sqlsrv_query($conn, $sql);
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$i=1;
			$sheet->setCellValue('A'.$i, 'LeadID');
			$sheet->setCellValue('B'.$i, 'CustID');
			$sheet->setCellValue('C'.$i, 'Description');
			$sheet->setCellValue('D'.$i, 'Product');
			$sheet->setCellValue('E'.$i, 'Date_Created');
			$sheet->setCellValue('F'.$i, 'Prod_ID');
			$i++;
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
		{
			$sheet->setCellValue('A'.$i, $row['LeadID']);
			$sheet->setCellValue('B'.$i, $row['CustID']);
			$sheet->setCellValue('C'.$i, $row['Description']);
			$sheet->setCellValue('D'.$i, $row['Product']);
			$sheet->setCellValue('E'.$i, $row['Date_Created']);
			$sheet->setCellValue('F'.$i, $row['Prod_ID']);
			
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