<?php
require 'configCookie.php';
require '../vendor/autoload.php';
setlocale(LC_ALL, 'en_US.UTF-8');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$sql='select * from customer';
$stmt=sqlsrv_query($conn, $sql);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
			$sheet->setCellValue('A1', 'Name');
			$sheet->setCellValue('B1', 'Surname');
			$sheet->setCellValue('C1', 'Email');
			$sheet->setCellValue('D1', 'Phone');
			$sheet->setCellValue('E1', 'Company');
			$sheet->setCellValue('F1', 'Designation');
			$sheet->setCellValue('G1', 'Address');
			$sheet->setCellValue('H1', 'City');
			$sheet->setCellValue('I1', 'Zip_code');
			$sheet->setCellValue('J1', 'Province');
			$sheet->setCellValue('K1', 'Country');
$i=2;

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
		{
			$sheet->setCellValue('A'.$i, $row['Name']);
			$sheet->setCellValue('B'.$i, $row['Surname']);
			$sheet->setCellValue('C'.$i, $row['Email']);
			$sheet->setCellValue('D'.$i, $row['Phone']);
			$sheet->setCellValue('E'.$i, $row['Company']);
			$sheet->setCellValue('F'.$i, $row['Designation']);
			$sheet->setCellValue('G'.$i, $row['Address']);
			$sheet->setCellValue('H'.$i, $row['City']);
			$sheet->setCellValue('I'.$i, $row['Zip_code']);
			$sheet->setCellValue('J'.$i, $row['Province']);
			$sheet->setCellValue('K'.$i, $row['Country']);
			
			$i++;
			
		}
		$writer = new Xlsx($spreadsheet);
//$writer->save('hello world.xlsx');

$temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
$writer->save($temp_file);

 $name="customer ".date("F j Y").".xlsx";
        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header('Content-Type: application/vnd.ms-excel');
        header ( "Content-Disposition: attachment; filename=".$name);
       readfile($temp_file);
?>