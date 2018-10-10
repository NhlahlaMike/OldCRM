<?php
require_once "Config.php";
$sql= "select [Prod_Name],[Prod_Price] from product";

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

$flag = true;
$table = array();
$table['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'Course Name', 'type' => 'string'),
    array('label' => 'Rand', 'type' => 'number')

);
   $arr = array ();
    while ( $r = sqlsrv_fetch_array ( $stmt ) ) {
    $temp = array();
    // the following line will be used to slice the Pie chart
    $temp[] = array('v' => (string) $r['Prod_Name']); 

    // Values of each slice
    $temp[] = array('v' => (int) $r['Prod_Price']); 
    $arr[] = array('c' => $temp);
    }
	
	$table['rows'] = $arr;
 echo $jsonTable = json_encode($table);


?>