<?php

//This will the admin to enter new products into the database 

require"config.php";
$mess='';
	if(isset($_POST['load'])){
	
	$prod_name = $_POST['prod_name'];
	$prod_desc = $_POST['prod_desc'];
	$prod_price = $_POST['prod_price'];
	
	
	$sql1= "select prod_id from dbo.Product";

$stmt1 = sqlsrv_query( $conn, $sql1);
	while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) 
		{
			$temp= explode("P",$row['prod_id']);
			
		}
		$temp[1]+=1;
		$str_length = 3;

// hardcoded left padding if number < $str_length
$prod_id= substr("0000{$temp[1]}", -$str_length);

		//$Prod_ID="P".$temp[1];
		 $prod_id="P".$prod_id;
	
	//adding products in the database
	$sql = "Insert into product(prod_id, prod_name, [Prod_Duration], prod_price)
		values('$prod_id','$prod_name', '$prod_desc', '$prod_price')";
	
	$stmt3 = sqlsrv_query( $conn, $sql);
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
$mess='<div style="width:300px" class="alert alert-success">Product has been Added </div>';
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Adding Products</title>
</head>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>

<fieldset>
<legend><h5 align="center"><font  color="#cccc00" face="Segoe" size="+6">Add Products Range</font></h5></legend>
<div class="container"> 


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">


Product Name:<br> <input type="text" name="prod_name" placeholder="Product Name" required>
<br>

Product Duration: <br><input type="text" name="prod_desc" placeholder="Product Duration" required>
<br>

Product Price: <br><input type="text" name="prod_price" placeholder="Product Price" required>
<br>
<br>
<button type="submit" name="load">Load product</button><br>
<a href="SaleManagerHome.php">Back </a> 
</form>
<?php echo $mess;?>
<body>
</body>
</html>