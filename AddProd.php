<?php

//This will the admin to enter new products into the database 

require"config.php";

	if(isset($_POST['load'])){
	
	$prod_name = $_POST['prod_name'];
	$prod_duration = $_POST['prod_duration'];
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
	$sql = "Insert into product(prod_id, prod_name, prod_duration, prod_price)
		values('$prod_id','$prod_name', '$prod_duration', '$prod_price')";
	
	$stmt3 = sqlsrv_query( $conn, $sql);
	
	echo "PRODUCT WAS SUCCESSFULLY ADDED!!!";
	
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
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Adding Products</title>
</head>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">


Product Name: <input type="text" name="prod_name" placeholder="Product Name" required>
<br>
<br>
Product Description: <input type="text" name="prod_duration" placeholder="Product Duration" required>
<br>
<br>
Product Price: <input type="text" name="prod_price" placeholder="Product Price" required>
<br>
<br>
<button type="submit" name="load">Load product</button>

</form>

<body>
</body>
</html>