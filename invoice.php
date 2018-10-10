<?php
ob_start();
session_start();
include 'session.php';

?>
<?php

require "config.php";
$message='';
$prodID=$_POST['ProdType'];
$prodD=$_POST['ProdName'];
$custID=$_POST['custID'];
$leadID=$_POST['leadID'];


 $sql2="INSERT INTO [dbo].[Lead]
           ([LeadID]
           ,[CustID]
           ,[Description]
           ,[Product]
           ,[Date_Created]
           ,[Prod_ID])
     VALUES
           ('$leadID'
           ,'$custID'
           ,''
           ,'$prodD'
           ,GetDate()
           ,'$prodID')
	 ";
//$params = array();
////$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
//$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$stmt2 = sqlsrv_query( $conn, $sql2 );
if( $stmt2 === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql2;
        }
    }
}else
$message= '<div class="alert alert-success">Lead added Successfully</div>';
//header('Location:view_cusFull.php');

?>
<?php
$sql1="SELECT * FROM dbo.Product where Prod_ID='$prodID'";
//$params = array();
////$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
//$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$stmt1 = sqlsrv_query( $conn, $sql1 );
if( $stmt1 === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql1;
        }
    }
}
		while( $row = sqlsrv_fetch_array( $stmt1,  SQLSRV_FETCH_BOTH) ) 
		{
			$prodD=$row['Prod_ID'];
			$proDdesc=$row['Prod_Name'];
			$prodPrice=$row['Prod_Price'];
			
			
			
		}
		
	$sql1= "select * from dbo.Invoice";
$stmt1 = sqlsrv_query( $conn, $sql1 );

	while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) 
		{
			
			$temp= explode("IN",$row['Invoice_ID']);
			
			
			
		}
		$temp[1]+=1;
		$num = 123;
$str_length = 3;

// hardcoded left padding if number < $str_length
$inv= substr("0000{$temp[1]}", -$str_length);

// output: 0123
		
		//$custID="L".$temp[1];
		  $inv="IN".$inv;
		  
		  
		  $sql3="INSERT INTO [dbo].[Invoice]
           ([Invoice_ID]
           ,[I_Status]
           ,[Invoice_cost]
           ,[Additional_Costs]
           ,[AC_Description]
           ,[Lead_ID])
     VALUES
           ('$inv'
           ,'Not Yet Paid'
           ,$prodPrice
           ,'0.0'
           ,''
           ,'$leadID')";
		   $stmt4 = sqlsrv_query( $conn, $sql3 );
		   if( $stmt4 === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql3;
        }
    }
}


?>



<!DOCTYPE html>


<html>
    <head>
        <title>Invoice</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <style>
            table tr:not(:first-child){
                cursor: pointer;transition: all .25s ease-in-out;
            }
            table tr:not(:first-child):hover{background-color: #ddd;}
        </style>
         <link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
        
    </head>
    <body>
<?php echo $message;


$mess='<div class="container">
  <h2>Invoice</h2>
              
  <table class="table table-condensed">
    <tbody>
      <tr>
        <td>Invoice ID</td>
        <td><input type="text" name="invoice" value="'.$inv.'" style="border: none" readonly></td>
      </tr>
      <tr>
        <td>lead ID</td>
        <td><input type="text" name="invoice" value="'.$leadID.'"  style="border: none" readonly></td>

      </tr>
      <tr>
        <td>Customer ID</td>
        <td><input type="text" name="invoice" value="'.$custID.'"  style="border: none" readonly></td>
      </tr>
	              <tr>
        <td>Product ID</td>
        <td><input type="text" name="invoice" value="'.$prodD.'" size="50px" style="border: none" readonly></td>
      </tr>
            <tr>
        <td>Product description</td>
        <td><input type="text" name="invoice" value="'.$proDdesc.'" size="50px" style="border: none" readonly></td>
      </tr>
            <tr>
        <td>Product Price</td>
        <td><input type="text" name="invoice" value="'.$prodPrice.'"  style="border: none" readonly></td>
      </tr>
    </tbody>
  </table>
</div>';
echo $mess;
$_SESSION['custid']=$custID;
$_SESSION['invoice']=$mess;
$_SESSION['invNO']=$inv;

?>
<form action="email_send.php" method="post">
<input type="submit" name="submit" value="Send email">
</form>
</body>
</html>
