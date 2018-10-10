<?php
session_start();
require"config.php";

if(isset($_POST["var"]))
setcookie('cust', $_POST["var"], time() + (86400 * 30), "/");

//var_dump($_COOKIE['cust']);
$cust=$_COOKIE['cust'];
$message='';
if(isset($_POST['submit'])){
$name=$_POST["name"];
$surname=$_POST["surname"];
$email=$_POST["email"];
$company=$_POST["company"];
$designation=$_POST["designation"];
$phone=$_POST["phone"];
$addr1=$_POST["addr1"];
$city=$_POST["city"];
$province=$_POST["province"];
$zip=$_POST["zip"];
//$sales=$_SESSION['name'];

$sql="UPDATE [dbo].[Customer]
   SET [Name] = '$name'
      ,[Surname] = '$surname'
      ,[Email] = '$email'
      ,[Phone] = '$phone'
      ,[Company] = '$company'
      ,[Designation] = '$designation'
      ,[Address] = '$designation'
      ,[City] = '$city'
      ,[Zip_code] = '$zip'
      ,[Province] = '$province'
 WHERE custid='$cust'";
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
$message= '<div id="success" class="alert alert-success"> Costumer edited Successfully</div>';
}




$sql="SELECT * FROM dbo.customer where custid='$cust'";
//$params = array();
////$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
//$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$stmt = sqlsrv_query( $conn, $sql );
//$name=$row['Name'];




?>

<!DOCTYPE html>
<html>
<head>

 <link href="../stylesheet.css" rel="stylesheet" type="text/css">

 <link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <br>
<fieldset>
<h1 align="center"><font  color="#FF0004" face="Segoe" size="+4">Customer Registration</font></h1>

<title> Customer Registration</title>
</head>
<body class="bod">
<div class="container">  
  <form id="contact" action="editcustomer.php" method="post">
  <?php
  	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
		{
			   
echo $hell0='Name
<input placeholder="Name" type="text"  value="'.$row['Name'].'" required autofocus name="name" >	 
<br><br>
Surname
<input placeholder="Surname" type="text" value="'.$row['Surname'].'"  name="surname" required  >
<br><br>
	Email Address*
<input type="email" name="email" required value="'.$row['Email'].'" placeholder="Enter email address" name="email">	
<br><br>
Company *
<input placeholder="Company" value="'.$row['Company'].'" type="text"  required name="company" >
<br><br>	
Position *
<input placeholder="Position" value="'.$row['Designation'].'" type="text"  required name="designation" >
<br><br>	  
Phone*
<input placeholder="Enter phone number" value="'.$row['Phone'].'" type="text" pattern="[0-9]{10}" name="phone"/>	  
<br><br>
	  
ID Address Line1 *
<input placeholder="Address line 1" value="'.$row['Address'].'" type="text" name="addr1" required >
<br><br>
	  
City Line2 *
<input placeholder="City" value="'.$row['City'].'" type="text"  required name="city" >
<br><br>
Province*
<input placeholder="Province"  name="province" value="'.$row['Province'].'"type="text" required >
<br><br>
(Zip)*

<input placeholder="Zip_code*" type="text"  value="'.$row['Zip_code'].'" required name="zip" >
<br><br>

<br><br>';
		}
?>




<button type="submit" class="btn btn-info" name="submit" > Save edited customer</button>
	  
<?php echo $message; ?> 
  </form>
 
</div>
</fieldset>
</body>
<script type="text/javascript">
setTimeout(function(){
  if ($('#success').length > 0) {
    $('#success').remove();
  }
}, 5000)
</script>
