
<?php
require_once ("../config.php");
$style='style="display: none;"';
if(isset($_POST['submit']))
{
$invoice=$_POST['invoice'];
$sql="select * from Invoice i,Lead l, Product p, Customer c
where i.Lead_ID=l.LeadID and p.Prod_ID=l.Prod_ID and l.CustID=c.CustID and i.Invoice_ID='$invoice'";
//$params = array();
////$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
//$stmt = sqlsrv_query( $conn, $sql , $params, $options );
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
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
     $inv=$row['Invoice_ID'];
	 $name=$row['Name'];
	 $surname=$row['Surname'];
	 $custid=$row['CustID'];
	 $prodDes=$row['Prod_Name'];
	 $price=$row['Invoice_cost'];
	 $payedStatus=$row['I_Status'];
}
if($payedStatus=='Not Yet Paid')
	{$mess='';
	$pay='';}
	else
	{$mess='checked';
	$pay='active';}
	if(isset($inv))
	$style='';
}


?>






<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Already Paid</title>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/build.css">
<link rel="stylesheet" href="../css/progress.css">
<link href="../table.css" rel="stylesheet" type="text/css">


  <script src="bootstrap-checkbox.min.js" defer></script>
</head>


<body>

<div align="center" style="margin:50px" >
<form action="alrPaid.php" method="post">
Invoice No.
<input type="text" name="invoice" placeholder="Invoice NO.">
<input type="submit" name="submit" value="Search">
<form>
<br><br>
</div>
<div id="divCheckbox"  <?php echo $style;?> >

<div align="center">

                    <div class="checkbox checkbox-success">
                        <input id="check5" class="styled" type="checkbox" <?php echo $mess;?> disabled>
                        <label for="check5">
                            Money Paid
                        </label>
                    </div>

                    <table align="center"  class="data-table">
                    

 <tr>
    <th><?php echo $name;?></th>
    <th><?php echo $surname;?></th> 
    
  </tr>
  <tr>
    <td>Invoice NO.</td>
    <td><?php echo $invoice;?></td> 
  </tr>
  <tr>
    <td>Customer ID</td>
    <td><?php echo $custid;?></td> 
  </tr>
    <tr>
    <td>Product</td>
    <td><?php echo $prodDes;?></td> 
  </tr>
    <tr>
    <td>Price</td>
    <td><?php echo $price;?></td> 
  </tr>
    <tr>
    <td>Payed Starus</td>
    <td><?php echo $payedStatus;?></td> 
  </tr>
  
</table>
</div>
<div align="center">
<a href="../layout1/layout1/index.html">Home</a>
</div>

</body>
</html>
