<?php

require "Config.php";

//include('session.php')

$sql = "select [Prod_Name] from Product";
$result = mysql_query($sql);

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

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head
><body>





Select Product: <select name="product">
<option value="<?=$row['Prod_Name']?>"><?=$row['Prod_Name']?></option>>
<? while($row=mysql_fetch_array($result)){
	?>
</select>

</body>
</html>