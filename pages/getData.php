<?php
require_once "Config.php";
$month= array('January','February','March','April','May','June','July','August','September','October','November','December');
 $year= date("Y");


$flag = true;
$table = array();
$table['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'Course Name', 'type' => 'string'),
    array('label' => 'Rand', 'type' => 'number')

);
$count=0;
$arr = array ();
while($count<=3){
	$sql= "select count(*) as date from lead where datename(MM,date_created) ='$month[$count]' and DATENAME(YEAR,[date_created])='$year'";
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
	while ( $r = sqlsrv_fetch_array ( $stmt ) ) {
		 $temp1[$count]=$r['date'];
		
	}
	$temp = array();
    // the following line will be used to slice the Pie chart
    $temp[] = array('v' => (string) $month[$count]); 

    // Values of each slice
    $temp[] = array('v' => (int) $temp1[$count]); 
    $arr[] = array('c' => $temp);
	$count++;
		
}


	
	$table['rows'] = $arr;
 echo $jsonTable = json_encode($table);


?>