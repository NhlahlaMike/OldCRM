<?php
session_start();
require "../config.php";
$message='';
//$SalesID
if(isset($_POST['submit'])){
$name=$_POST["name"];
$surname=$_POST["surname"];
$role=$_POST["role"];
$email=substr($name,0,1).$surname."@".$_SESSION['database'];
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
      ,[Employee_status])
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
           ,'No Picture'
           ,''
           ,1)
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
$message='<div id="success" class="alert alert-success">Added Successfully</div>';
}
?>

<!DOCTYPE html>
<html>
<title>Add sales</title>
<head>
<fieldset>
<body bgcolor="silver">

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<fieldset>
<legend><h5 align="center"><font  color="#FF0004" face="Segoe" size="+6">Add Sales Member</font></h5></legend>
<div class="container"> 
    <?php echo $message; ?>   
<a href="AdminMenu.html">Back menu</a > 

<form id="contact" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    
 
Name:<br>
<input placeholder="Name" type="text"  required autofocus name="name" required autofocus>
  <br>
Surname:<br>
<input placeholder="Surname" name="surname" type="text"  required autofocus >
   <br>
Position:<br>
<input type="text" name="role" required autofocus>
   <br>
Password:<br>
<input placeholder="password" type="text" name ="password"  size ="20"required autofocus>
  <br><br>
  <border>
<button type="submit" name="submit"> Add Sales Member</button>
<br>
</div>
</form>
      <script type="text/javascript">
        setTimeout(function(){
        if ($('#success').length > 0) 
        {
        $('#success').fadeOut("slow");
        /*$('#success').fadeOut(500); */
        }
        }, 1000)
     </script>

</fieldset>
</head>
</html>
