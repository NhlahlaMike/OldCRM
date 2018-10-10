
<?php
ob_start();

session_start();
//include 'session.php';

?>
<?php

require "light/config.php";
$message='';
//$custID
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
$country=$_POST["country"];
$sales=$_SESSION['name'];
$status=$_POST["dropdown"];
$comment = $_POST["comment"];


$sql1= "select CustID from dbo.customer";
$stmt1 = sqlsrv_query( $conn, $sql1 );

	while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) 
		{
			$temp= explode("C",$row['CustID']);
			
		}
		$temp[1]+=1;
		$num = 123;
$str_length = 3;

// hardcoded left padding if number < $str_length
$custID= substr("0000{$temp[1]}", -$str_length);

// output: 0123
		
		//$custID="C".$temp[1];
		 $custID="C".$custID;

$sql="INSERT INTO [dbo].[Customer]
           ([CustID]
           ,[Name]
           ,[Surname]
           ,[Email]
           ,[Phone]
           ,[Company]
           ,[Address]
           ,[City]
           ,[Zip_code]
           ,[Province]
           ,[Country]
           ,[Date_Added]
           ,[SalesID]
		   ,[Designation]
		   ,[Comment])
     VALUES
           ('$custID'
           ,'$name'
           ,'$surname'
           ,'$email'
		   ,'$phone'
           ,'$company'
           ,'$addr1'
           ,'$city'
           ,'$zip'
           ,'$province'
		   ,'$country'
		   ,GetDate()
		   ,'$sales'
		   ,'$designation'
		   ,'$comment')
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
}else{

$message= '<div id="success" class="alert alert-success">Customer added Successfully</div>';
if($status=='New opportunity'){
	$_SESSION['custID']=$custID;
	//header('Location:leadProd.php');	
}

}


$sql2= "select StatusID from dbo.status";
$stmt2 = sqlsrv_query( $conn, $sql2 );

	while( $row = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) 
		{
			$temp= explode("ST",$row['StatusID']);
			
		}
	$num=	(int)$temp[1];
$num+=1;
		
$str_length = 3;

// hardcoded left padding if number < $str_length
$StatusID= substr("0000{$num}", -$str_length);

// output: 0123
		
		//$custID="C".$temp[1];
		  $StatusID="ST".$StatusID;
		 
$sql3="INSERT INTO [dbo].[Status]
           ([StatusID]
           ,[CustID]
           ,[Status_Name]
           ,[Status_Date])
     VALUES
           ('$StatusID'
           ,'$custID'
           ,'Not Attempted'
           ,getdate())";
		   $stmt3 = sqlsrv_query( $conn, $sql3 );
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


$sql6= "select * from dbo.[AssignTask]";
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
		 $taskID="A".$leadID;
		 }
		 else
		 $taskID="A001";
		 
		 
		 $sql8= "INSERT INTO dbo.AssignTask
        (tsID,SalesID, stMonth, custid)
        VALUES ('$taskID','$sales', getdate(), '$custID');";
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
}
?>


<!DOCTYPE html>
<html>
<head>
 <link href="stylesheet.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js">
        </script>
<fieldset>
<h5 align="center"><font  color="#cccc00" face="Segoe" size="+4">Manual Registration</font></h5>
<title> Customer Registration</title>
</head>
<body class="bod">
<div class="container">  
<form id="contact" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Name *
<input placeholder="Name" type="text"  required autofocus name="name" >
<br><br>
Surname *
<input placeholder="Surname" name="surname" type="text"  required >
<br><br>
Email Address *
<input type="email" name="email" required placeholder="Enter email address">
<br><br>
Company *
<input placeholder="Company" type="text" name ="company"  required >
<br><br>
Designation *
<input placeholder="Designation" type="text" name ="designation"  required >
<br><br>
Phone*
<input placeholder="Enter phone number" name="phone" type="text" pattern="[0-9]{10}"/>
<br><br>
ID Address Line1 *
<input placeholder="Address line 1" name="addr1" type="text"  required >
<br><br>
City Line2 *
<input placeholder="City" type="text" name="city"  required >
<br><br>
Province*
<input placeholder="Province" name="province" type="text" required >
<br><br>
(Zip)*
<input placeholder="Zip*" name= "zip" type="text"  required >
<br><br>
<label for="country">Country*</label>
<select name="country" size="1"> 
 <option value="Afghanistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="United Kingdom">United Kingdom</option>
<option value="American Samoa">American samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua">Antigua</option>
<option value="South Africa">South Africa</option>
<option value="Armenia">Armenia</option><option value="Aruba">Aruba</option>
<option value="Australia">Austtralia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="The Bahamas">The bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Uganda">Uganda</option>
<option value="Zimbabwe">Zimbabwe</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Taiwan">Taiwan</option>
<optiohn value="Bhutan">Bhutan</select>

<form>
</select>

<br><br>
<label for="status">Status*</label>
<select name="dropdown" size="1"> 
<option value="Attempted">Attempted</option> 
<option value="New opportunity">New opportunity</option> 
<option value="Contacted">Contacted</option>
<option value="Additional Contact">Additional Contact</option>
</select>
<br><br>
Comment:
<textarea name="comment" rows="5" cols="100" placeholder="Type in a comment..."></textarea>
<br><br><br><br><br><br><br>
<button type="submit" name='submit' > Submit Client</button>
</form>
<?php echo $message?>
</div>

</fieldset>
<script>
    $(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
	
	setTimeout(function(){
  if ($('#success').length > 0) {
    $('#success').remove();
  }
}, 5000)
</script>

</body>
