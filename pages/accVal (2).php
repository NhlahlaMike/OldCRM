<?php

$pass=$_POST['password'];
$user=$_POST['email'];
$count="0";
require "Config.php";
        // To protect MySQL injection
$user = stripslashes($user);
$pass = stripslashes($pass);
//$user = mysql_real_escape_string($user);
//$pass = mysql_real_escape_string($pass);

$sql="SELECT count(*) as 'user' FROM dbo.ID WHERE username like '%$user' and password like '%$pass'";
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
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
     $count=$row['user'];
}

//.echo $count."<br/>";
if($count=="1")
{
    include "sales.html";
}else{
echo "check if u entered the correct creditials ";
}

sqlsrv_free_stmt( $stmt);
        

?>