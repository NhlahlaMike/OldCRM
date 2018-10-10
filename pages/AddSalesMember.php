<?php
ob_start();
session_start();
//include 'sessNosale.php';

?>
<?php


require "light/config.php";
$mess='';
//$SalesID
if(isset($_POST['submit'])){
$name=$_POST["name"];
$surname=$_POST["surname"];
$role=$_POST["role"];
$email=$_POST["email"];
$password=$_POST["password"];


$sql1= "select SalesID from dbo.Sales_Rep";
$stmt1 = sqlsrv_query( $conn, $sql1 );

	while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) 
		{
			$temp= explode("S",$row['SalesID']);
			
		}
		$temp[1]+=1;
		$num = 123;
$str_length = 3;

// hardcoded left padding if number < $str_length
$SalesID= substr("0000{$temp[1]}", -$str_length);

// output: 0123
		
		//$custID="C".$temp[1];
		 $SalesID="S".$SalesID;

$sql="INSERT INTO [dbo].[Sales_Rep]
           ([SalesID]
      ,[S_Name]
      ,[S_Surname]
      ,[S_Role]
      ,[S_Emails]
      ,[S_Password]
      ,[Address]
      ,[City]
      ,[Postal_code]
      ,[Profile_Picture]
      ,[Country]
      ,[Employee_Status])
     VALUES
           ('$SalesID'
           ,'$name'
           ,'$surname'
           ,'$role'
           ,'$email'
           ,'$password'
           ,''
           ,''
           ,''
           ,''
           ,''
           ,'1')
	 ";
//$params = array();
////$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
//$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql;
        }
    }
}
$mess='<div style="width:300px" class="alert alert-success">Sales Consultant has been Added </div>';
}
?>

<!DOCTYPE html>
<html>

<head>
<title>Add sales</title>
</head>
<fieldset>
<body bgcolor="silver">

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>

<fieldset>
<legend><h5 align="center"><font  color="#cccc00"face="Segoe" size="+6">Add Sales Member</font></h5></legend>
<div class="container"> 

<form id="contact" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Name:<br>
<input placeholder="Name" type="text"  required autofocus name="name" >
  <br>
Surname:<br>
<input placeholder="Surname" name="surname" type="text"  required autofocus >
   <br>
Position:<br>
<input type="text" name="role" required autofocus>
   <br>
Email:<br>
<input type="email" name="email" required placeholder="Enter Email Address" required autofocus>
   <br>
Password:<br>
<input placeholder="password" type="text" name ="password"  size ="20"required autofocus>
  <br><br>
  <border>
<button type="submit" name="submit"> Add Sales Member</button>
<br>
<a href="TeamLeaderHome.php">Back </a > 


</form>
</div>
<?php echo $mess ?>
</fieldset>
</body>


</html>
