<?php
session_start();
 //error_reporting(0);


require "config.php";
$message='';
//get sales members
if(!empty($_SESSION['message'])){
$_SESSION['message']=$message;
$_SESSION['message']='';
}
//var_dump($_SESSION['message']);
$sql = "select * from sales_rep where [Employee_status]='1'";
$stm=sqlsrv_query($conn,$sql);


    $sql8= "select * from dbo.AssignTask";
    $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt8 = sqlsrv_query($conn, $sql8, $params, $options);
	 $task=sqlsrv_num_rows($stmt8);
	//echo '<br>';
    if($task>0)
    {
        $sql1='select distinct c.CustID,Name,Surname from Customer c, AssignTask a
        where c.CustID not in (select AssignTask.custid from AssignTask)';
    }
    else 
    {
        //NO. of customer
        $sql1= "select * from dbo.customer";
    }

$count=0;
		$stmt = sqlsrv_query( $conn, $sql1 );

	


if(isset($_POST['submit'])){
	

		 
		 
		

$foo=$_POST['foo'];
$count=0;
while (!empty($foo[$count]))
{
		$sql6= "select * from dbo.[AssignTask]";
    $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt6 = sqlsrv_query($conn, $sql6, $params, $options);
	if (sqlsrv_num_rows($stmt6) >= 1)
{
	while( $row = sqlsrv_fetch_array( $stmt6, SQLSRV_FETCH_ASSOC) ) 
		{
			
			$temp= explode("A",$row['tsID']);
			
			
			
		}
		$temp[1]+=1;
		$num = 123;
$str_length = 3;

// hardcoded left padding if number < $str_length
$leadID= substr("0000{$temp[1]}", -$str_length);

// output: 0123
		
		//$custID="L".$temp[1];
		 $taskID="A".$leadID;
		 }
		 else
		 $taskID="A001";
		 
		// echo $taskID;
	
	
	
	//echo '<pre>';
	//echo $foo[$count];
	//echo '</pre>';
	$sale=$_POST['select'];
$sql8= "INSERT INTO dbo.AssignTask
        (tsID,SalesID, stMonth, custid)
        VALUES ('$taskID','$sale', getdate(), '$foo[$count]');";
    $stqr = sqlsrv_query( $conn, $sql8 );  
    if( $stqr === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql8;
        }
    }
}



	$count++;
	
}

 $_SESSION['message']= '<div id="success" class="alert alert-success">'.$count.' Leads have been Assigned Task</div>';
  $message=$_SESSION['message'];
}



?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/build.css">
<link rel="stylesheet" href="../css/progress.css">
<link href="../table.css" rel="stylesheet" type="text/css">

<body>
  <script src="bootstrap-checkbox.min.js" defer></script>
  <h2 align="center"> Assign Task</h2>
</head>


<form action="assigntask.php" method="post">
<div id="divCheckbox" style="margin-left:200px;margin-bottom: 100px"  >

<div id="selectbox">

<select name="select">
<option disabled>Select Sale Member</option>
<?php
 error_reporting(0);
while( $row = sqlsrv_fetch_array( $stm, SQLSRV_FETCH_ASSOC) ) 
echo '<option value="'.$row['SalesID'].'">'.$row['S_Name'].' '.$row['S_Surname'].'</option>';

?>
</select>
</div>
<br>
<br>
<div style="overflow:auto; height:200px;width:300px">
 
  <?php
   error_reporting(0);

			while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
			//$all=array();
		{
		
			  $InvoiceID=$row['CustID'];
			  //$leadID=$row['LeadID'];
			  $name=$row['Name'];
			  $surname=$row['Surname'];
			  //$cust[$count]=$row['CustID'];
			 
			   $all=$name." ".$surname;
			   	echo '<div class="checkbox checkbox-success">';
echo '<li style="list-style-type:none"><input id="check5" class="styled" type="checkbox" name="foo[]" value="'.$InvoiceID.'"> ';
echo '<label >
               '.$all.'
                        </label></li';
echo '</div>';
			   
			 
			
		}



?>
</div>
</div>
  
  <input type="submit" name="submit" value="Assign">
</form>
<?php echo $message;
 error_reporting(0);
//unset($_SESSION['message']) ?>
<script type="text/javascript">
//Place as last thing before the closing </body> tag
if(location.search.indexOf('reloaded=yes') < 0){
    var hash = window.location.hash;
    var loc = window.location.href.replace(hash, '');
    loc += (loc.indexOf('?') < 0? '?' : '&') + 'reloaded=yes';
    // SET THE ONE TIME AUTOMATIC PAGE RELOAD TIME TO 5000 MILISECONDS (5 SECONDS):
    setTimeout(function(){window.location.href = loc + hash;}, 500);
}

setTimeout(function(){
  if ($('#success').length > 0) {
    $('#success').remove();
  }
}, 5000)
</script>
</body>