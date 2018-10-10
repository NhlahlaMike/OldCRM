<?php
ob_start();
//session_start();
        $serverName = "UJSER-PC\SQLEXPRESS";
        $UID = "IKWORX\gtimba";
        $PWD = "M@gofifi1";
        $Database = "CRM_db";
        
        $connectionInfo = array( "Database"=>$_SESSION['database'],"CharacterSet" => "UTF-8");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);

?>