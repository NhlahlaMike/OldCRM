<?php
require_once "ConfigCookie.php";
//Array for months
$month= array('January','February','March','April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');



$flag = true;
$table = array();
$table['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'Months', 'type' => 'string'),
    array('label' => 'Leads', 'type' => 'number')

);
$count=0;
$arr = array ();

//this gets all the number of months from the DB for the year 2018

while($count<=11){
	
	$sql= "select count(*) as date from Customer c where datename(MM, c.Date_Added) ='$month[$count]' and datename(yy, c.Date_Added) = '2018'";
	//$sql= "select count(*) as date from lead where datename(MM,date_created) ='$month[$count]'";
	$stmt = sqlsrv_query( $conn, $sql );
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