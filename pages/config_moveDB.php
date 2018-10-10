<?php
        $serverName = "UJSER-PC\SQLEXPRESS";
        $UID = "IKWORX\gtimba";
        $PWD = "M@gofifi1";
        $Database = "movedb";
        
        $connectionInfo = array( "Database"=>$Database);
        $conn = sqlsrv_connect( $serverName, $connectionInfo);

?>