<?php

ob_start();
//session_start();
require "config.php"
?>
<?php
$name=$_SESSION['name'];
$username=$_SESSION['username'];
$role= $_SESSION['Role'];
$sql="SELECT * FROM dbo.Sales_Rep WHERE S_Emails = '$username' and SalesID like '$name' and s_role != 'Consultant'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
//$stmt = sqlsrv_query( $conn, $sql );

if(sqlsrv_num_rows( $stmt )>0){	
  
}
 else {
 
     if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql;
        }
	}
        $_SESSION['message'] =  '<div class="alert alert-error">Check Your Creditials</div>';
    header('Location:index.php');
     
}
?>

