
<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
//
session_start();

$ivoice=$_GET['ref'];
$comp=$_GET['comp'];
 $_SESSION['database']=$comp;
 
 if(!isset($_COOKIE['database']))
 setcookie('database', $comp, time() + (86400 * 30), "/");
 
$_SESSION['invoice']= $ivoice;
require "PayPal-PHP-SDK/autoload.php";
require_once "config.php";
require "paypal/exchange.php";
$sql3="select  count(*) as sum from payment where invoice_id='$ivoice' and Payment_Status =1";
$verify = sqlsrv_query( $conn, $sql3 );
while( $row = sqlsrv_fetch_array( $verify,  SQLSRV_FETCH_BOTH) ) 
		{	  $details=$row['sum'];
				
			}
			if($details==0){
$sql="select  Invoice_cost ,custid, Prod_Name from invoice i,lead l,Product p
where i.Lead_ID=l.LeadID and p.Prod_ID=l.Prod_ID and i.Invoice_ID='$ivoice'";
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
while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
		{	 $price=$row['Invoice_cost'];
				$cust=$row['custid'];
				$prod=$row['Prod_Name'];
			}
			$_SESSION['Prod_Name']=$prod;
			$_SESSION['CustID']=$cust;
//API
$api = new ApiContext(
	new OAuthTokenCredential(
	'AaFpuNfAHX0pb-eU0-Vs1xgOZ-8NaINaizy7WxagWiSDZgVlS9TVrlk024MpetP6mMufF02huM6ER7qz',
	'EJJFWJuo-PJcUcEb6ZlINPix3W9kIL35uD4tItHKXsFh4PyhG6ooC4As830dWhTwQW8PlK3HPzV_wp-D')

	);
	$api->setConfig([
	'mode'=>'sandbox',
	'http.ConnectionTimeOut'=>30,
	'log.Enabled'=>true,
	'log.FileName'=>'paypal.log',
	'log.LogLevel'=>'FINE',
	'validation.level'=>'log']);

/*function convertCurrency($amount, $from, $to){
	$data = file_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$from&to=$to");
	preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);

	$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
	return number_format(round($converted, 3),2);
}*/

 //$dollar =convertCurrency($price, "ZAR", "USD");
 $dollar=rates($price);
$_SESSION['dollar']=$dollar;}
 else if ($details==1)
 header('Location:paypal/alrPaid.php');
 else
 header('Location:paypal/error.php');
?>


<html>
<title> Payment methods</title>
<head>
<meta charset="utf-8">
<link href="stylesheet.css" rel="stylesheet" type="text/css">
<link href="css/build.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<script src="js/bootstrap.min.js"></script>
<h5 align="center"><font  color="#FF0004" face="Segoe" size="+6">Make Payment</font></h5>
</head>
<body>
<div align="center" class="one-third">

<div align="center" class="cake">
<br>
<img src="pic.png" alt="card methods" width="350" height="40">
<br>
<form action="payment_redirect.php" method="post">
<br>

<label>
Payment Method:
</label>
<select name="Payment"required autofocus>
    <option value="Payment">PayPal</option>

  </select><br><br>
Product Cost:
<input placeholder="R" type="text" name="product" pattern="[0-9]{10}" readonly value="<?php echo $price; ?>"/>
<br><br>
Product Cost ($):
<input placeholder="$" type="text" name="dollar" pattern="[0-9]{10}" readonly value="<?php echo $dollar; ?>"/>
<br><br>
Invoice No:
<input placeholder="Invoice" type="text" name="invoice" value="<?php echo $_SESSION['invoice']; ?>" readonly />
<br><br>
No. Of Delegate:
<input placeholder="No. of Quantity" type="text" name="quantity" value="1"  />
<br><br>
<p>The Conversion to USD is happening in Real time</p>


<center><button type="submit"> Confirm Payment</button></center>
<br>
	<center><button  type="cancel"> Cancel</button></center>

</form>
</div>

</div>
</body>
</html>
