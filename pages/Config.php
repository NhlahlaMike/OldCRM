<?php
       $serverName = "192.168.176.35\SQLEXPRESS";
        $UID = "ikworx";
        $PWD = "Xibelani@54";
        $Database = "CRM_db";
        
        $connectionInfo = array( "Database"=>$Database,"CharacterSet" => "UTF-8","UID"=>$UID,"PWD"=>$PWD);
        $conn = sqlsrv_connect( $serverName, $connectionInfo);

?>