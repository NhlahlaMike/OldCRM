
<?php
require('../config.php');
	$sql3= "select * from dbo.sales_rep";
$stmt3 = sqlsrv_query( $conn, $sql3 );

	while( $row = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC) ) 
		{	
			$tes[]=$row['SalesID'];
		}


//NO. of customer
$sql1= "select * from dbo.customer";
$stmt7 = sqlsrv_query( $conn, $sql1 );
 $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt7 = sqlsrv_query($conn, $sql1, $params, $options);
	 $customer=sqlsrv_num_rows($stmt7);
	 '<br>';
	
//No of Sales
$sql1= "select * from dbo.sales_rep";
$stmt1 = sqlsrv_query( $conn, $sql1 );
 $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt2 = sqlsrv_query($conn, $sql1, $params, $options);
	 $sales=sqlsrv_num_rows($stmt2);
	//echo '<br>';
		$div=$customer/$sales;
		 $div=(int)$div;
		//echo '<br>';
//getting no. of customers
$count=0;
$sales1=0;
$sql13= "select * from dbo.customer";
$stmt13 = sqlsrv_query( $conn, $sql13 );
	while( $row = sqlsrv_fetch_array( $stmt13, SQLSRV_FETCH_ASSOC) ) 
		{
			 $cust=$row['CustID'];
			
			if($count>$div-1)
			{
				$count=0;
				
				 $sales1+=1;
				if($sales1>=$div-1)
				break;
				//echo '<br>';
			}
			$sql6= "select * from dbo.[AssignTask]";
$stmt6 = sqlsrv_query( $conn, $sql6 );
 $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt6 = sqlsrv_query($conn, $sql6, $params, $options);
	if (sqlsrv_num_rows($stmt6) >= 1)
{
	while( $row = sqlsrv_fetch_array( $stmt6, SQLSRV_FETCH_ASSOC) ) 
		{
			
			$temp= explode("A",$row['tsID']);
			
			
			
		}
		$temp[1]+=1;
		$num = 123;
$str_length = 3;

// hardcoded left padding if number < $str_length
$leadID= substr("0000{$temp[1]}", -$str_length);

// output: 0123
		
		//$custID="L".$temp[1];
		 $leadID="A".$leadID;
		 }
		 else
		 $leadID="A001";
		 
		  
			
			
			$sql8= "INSERT INTO dbo.AssignTask
        (tsID,SalesID, stMonth, custid)
        VALUES ('$leadID','$tes[$sales1]', getdate(), '$cust');";
    $stqr = sqlsrv_query( $conn, $sql8 );  
    if( $stqr === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql8;
        }
    }
}
			echo '<br>';
			$count++;
		}
		
		



?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
