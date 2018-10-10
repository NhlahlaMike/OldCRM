<?php

include 'configCookie.php';
$name=$_POST["name"];
$surname=$_POST["surname"];
//$email=$_POST["email"];
//$company=$_POST["company"];
//$designation=$_POST["designation"];
//$phone=$_POST["phone"];
$addr1=$_POST["address"];
$city=$_POST["city"];
//$province=$_POST["province"];
$zip=$_POST["zip"];
$country=$_POST["country"];
$sales=$_POST["saleid"];
//$status=$_POST["dropdown"];

$sql="UPDATE [dbo].[Sales_Rep]
   SET [S_Name] = '$name'
      ,[S_Surname] = '$surname'
      ,[Address] = '$addr1'
      ,[Postal_code] = '$zip'
      ,[Country] = '$country'
 WHERE salesid='$sales'";
 
$stmt3 = sqlsrv_query( $conn, $sql );
if( $stmt3 === false ) {
if( ($errors = sqlsrv_errors() ) != null) {
 foreach( $errors as $error ) {
     echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
     echo "code: ".$error[ 'code']."<br />";
     echo "message: ".$error[ 'message']."<br />";
     echo $sql;
     die;
 }
}
}
 
 
 
 echo $message= '<div class="alert alert-success">Customer added Successfully</div>';






?>