<?php
//fetch.php;
//$user='S001';

if(isset($_POST["view"]))
{
	if(isset($_GET['field']))
$user=$_GET['field'];
 include("../config.php");
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE notify SET status=1 WHERE status=0 and salesid='$user'";
  sqlsrv_query($conn, $update_query);
 }
$sql="SELECT * FROM notify where salesid='$user' ";
 $params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$output='';
 while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
  {
   $output .= '
   <li>
    <a href="fetch.php">
     <strong>'.$row["Title"].'</strong><br />
     <small><em>'.$row["Comment"].'</em></small>
    </a>
   </li>
   <li class="divider"></li>
   ';
  }

 
 $query_1 = "SELECT * FROM notify WHERE status='0' and salesid='$user'";
 //$result_1 = sqlsrv_query($conn, $query_1);
 $params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result_1 = sqlsrv_query( $conn, $query_1 , $params, $options );
  $count = sqlsrv_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);

}
?>