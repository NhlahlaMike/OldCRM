<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?PHP
require "config.php";


$year = "2018";
$Strdate = "$year-01-01";
$date = date($Strdate);
 
 //for jan
                
$sql2 = "select count(*) from lead where datename(MM, date_created) = 'January'";
$stmt2 = sqlsrv_query( $conn, $sql2 ); 
$rows = sqlsrv_fetch_array($stmt2);
echo $rows[''];
 //for feb
                
$sql3 = "select count(*) from lead where datename(MM, date_created) = 'February'";
$stmt = sqlsrv_query( $conn, $sql3); 
$rows = sqlsrv_fetch_array($stmt3);
echo $rows[''];
 //for march
                
$sql4 = "select count(*) from lead where datename(MM, date_created) = 'March'";
$stmt4 = sqlsrv_query( $conn, $sql4 ); 
$rows = sqlsrv_fetch_array($stmt4);
echo $rows[''];
 //for april
                
$sql5 = "select count(*) from lead where datename(MM, date_created) = 'April'";
$stmt5 = sqlsrv_query( $conn, $sql5); 
$rows = sqlsrv_fetch_array($stmt2);
echo $rows[''];
 //for may
                
$sql6 = "select count(*) from lead where datename(MM, date_created) = 'May'";
$stmt6 = sqlsrv_query( $conn, $sql6 ); 
$rows = sqlsrv_fetch_array($stmt6);
echo $rows[''];
 //for june
                
$sql7 = "select count(*) from lead where datename(MM, date_created) = 'June'";
$stmt7 = sqlsrv_query( $conn, $sql7); 
$rows = sqlsrv_fetch_array($stmt7);
echo $rows[''];
 //for july
                
$sql8 = "select count(*) from lead where datename(MM, date_created) = 'July'";
$stmt8 = sqlsrv_query( $conn, $sql8); 
$rows = sqlsrv_fetch_array($stmt8);
echo $rows[''];
 //for aug
                
$sql9 = "select count(*) from lead where datename(MM, date_created) = 'August'";
$stmt9 = sqlsrv_query( $conn, $sql9); 
$rows = sqlsrv_fetch_array($stmt9);
echo $rows[''];
 //for sep
                
$sql10 = "select count(*) from lead where datename(MM, date_created) = 'September'";
$stmt10 = sqlsrv_query( $conn, $sql10); 
$rows = sqlsrv_fetch_array($stmt10);
echo $rows[''];
 //for oct
                
$sql11 = "select count(*) from lead where datename(MM, date_created) = 'October'";
$stmt11 = sqlsrv_query( $conn, $sql11); 
$rows = sqlsrv_fetch_array($stmt11);
echo $rows[''];
 //for nov
                
$sql12 = "select count(*) from lead where datename(MM, date_created) = 'November'";
$stmt12 = sqlsrv_query( $conn, $sql12 ); 
$rows = sqlsrv_fetch_array($stmt12);
echo $rows[''];
 //for dec
                
$sql13 = "select count(*) from lead where datename(MM, date_created) = 'December'";
$stmt13 = sqlsrv_query( $conn, $sql13 ); 
$rows = sqlsrv_fetch_array($stmt13);
echo $rows[''];
 //for jan

$months = array("January","February","March","April","May","June","July","August","September","October","November","December");


//        var data = google.visualization.arrayToDataTable([
        //  ['Months', 'Number of Leads per month'],
          //['January', 5],
          //    ['February', 50],
        //  ['March', 6],
       //    ['April', 30],
		//   ['May', 64],
		 //  ['June', 20],
		 //  ['July', 15],
		  // ['August', 53],
		  // ['September', 45],
		  // ['October', 28],
		  // ['November', 15],
		 //  ['December', 55]

?>
<body>
</body>
</html>