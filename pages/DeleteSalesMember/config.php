<?php
ob_start();
//session_start();
        $serverName = "192.168.176.32\SQLEXPRESS";
        $UID = "ikworx";
        $PWD = "Xibelani@54";
        $Database = "CRM_db";
        
       //$connectionInfo = array( "Database"=>$Database,"CharacterSet" => "UTF-8","UID"=>$UID,"PWD"=>$PWD);
		  $connectionInfo = array( "Database"=>$_SESSION['database'],"CharacterSet" => "UTF-8","UID"=>$UID,"PWD"=>$PWD);
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
?>