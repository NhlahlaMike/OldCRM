<?php
        $serverName = "192.168.176.32\SQLEXPRESS";
        $UID = "ikworx";
        $PWD = "Xibelani@54";
        $Database = "SuperUsers";
        
        $connectionInfo = array( "Database"=>$Database,"CharacterSet" => "UTF-8","UID"=>$UID,"PWD"=>$PWD);
        $super = sqlsrv_connect( $serverName, $connectionInfo);
	/*	if( $super ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
	 
}*/

?>

