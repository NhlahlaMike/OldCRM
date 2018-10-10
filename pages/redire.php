<?php
require "config.php";
$up=$_POST['lcopy'];
$update="UPDATE [dbo].[Status]
   SET [Status_Name] = 'Disqualified',
    [Status_Date]=getdate()
 WHERE custID='$up'";
 $stmt2 = sqlsrv_query( $conn, $update );
 if( $stmt2 === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql;
        }
    }
}
header('Location:view_cusFull.php');
?>
