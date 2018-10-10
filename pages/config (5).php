<?php
        $serverName = "IT009-PC\SQLEXPRESS";
        $Database = "CRM_db";
        $connectionInfo = array( "Database"=>$Database,"ReturnDatesAsStrings"=> false);
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
?>