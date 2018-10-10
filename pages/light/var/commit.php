<?php
session_start();



require "../config.php";
$sql="select * from invoice i, Lead l, Product p, Customer c where [I_Status]= 'Not Yet Paid'
and i.Lead_ID=l.LeadID and p.Prod_ID=l.Prod_ID and l.CustID=c.CustID ";

$count=0;
		$stmt = sqlsrv_query( $conn, $sql );
			while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
			//$all=array();
		{
		
			  $InvoiceID[$count]=$row['Invoice_ID'];
			  $leadID=$row['LeadID'];
			  $name=$row['Name'];
			  $surname=$row['Surname'];
			  $cust[$count]=$row['CustID'];
			 
			   $all[$count]=$InvoiceID[$count]." ".$name." ".$surname;
			   $count++;
			 
			
		}
	


if(isset($_POST['submit'])){

$foo=$_POST['foo'];
$count=0;
while (!empty($foo[$count]))
{
	$pay=uniqid('PAY-');
	$sql2="
INSERT INTO [dbo].[Payment]
           ([Payment_ID]
           ,[Payment_Method]
           ,[Payment_Date]
           ,[Invoice_ID]
           ,[Payment_Status])
     VALUES
           ('$pay'
           ,'Manual'
           ,getdate()
           ,'$foo[$count]'
           ,1)";
		   
		   
	$stmt2 = sqlsrv_query( $conn, $sql2 );

		$updateInvoice= "update invoice
						set [I_Status]='Payed'
						where [Invoice_ID]='$foo[$count]'";
		$stmt1 = sqlsrv_query( $conn, $updateInvoice );



	$count++;
	
}

}



?><head>

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/build.css">
<link rel="stylesheet" href="../css/progress.css">
<link href="../table.css" rel="stylesheet" type="text/css">

<body>
  <script src="bootstrap-checkbox.min.js" defer></script>
</head>

<form action="commit.php" method="post">
<div id="divCheckbox"   >

<div align="center">
  
  <?php
  $count=0;
while(!empty($all[$count])){
	echo '<div class="checkbox checkbox-success">';
echo '<input id="check5" class="styled" type="checkbox" name="foo[]" value="'.$InvoiceID[$count].'"> ';
echo '<label >
               '.$all[$count].'
                        </label>';
echo '</div>';
$count++;
}
?>
</div>
</div>
  
  <input type="submit" name="submit" value="Submit">
</form>
<script type="text/javascript">
//Place as last thing before the closing </body> tag
if(location.search.indexOf('reloaded=yes') < 0){
    var hash = window.location.hash;
    var loc = window.location.href.replace(hash, '');
    loc += (loc.indexOf('?') < 0? '?' : '&') + 'reloaded=yes';
    // SET THE ONE TIME AUTOMATIC PAGE RELOAD TIME TO 5000 MILISECONDS (5 SECONDS):
    setTimeout(function(){window.location.href = loc + hash;}, 500);
}
</script>
</body>