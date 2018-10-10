<?php
session_start();
use PayPal\api\Payer;
use PayPal\api\Details;
use PayPal\api\Amount;
use PayPal\api\Transaction;
use PayPal\api\Payment;
use PayPal\api\RedirectUrls;
use PayPal\Api\Item;
use PayPal\Api\ItemList;

$dola=$_SESSION['dollar'];
$invo=$_SESSION['invoice'];
$descrip=$_SESSION['Prod_Name'];
$cust=$_SESSION['CustID'];
$quatity=$_SESSION['quantity'];

require "getref.php";
require 'configCookie.php';
$payer=new Payer();
$details = new Details();
$amount= new Amount();
$transaction = new Transaction();
$payment= new Payment();
$redirectUrls= new RedirectUrls();
$total=$dola*$quatity;
//ItemList
$item1 = new Item();
$item1->setName($descrip)
    ->setCurrency('USD')
    ->setQuantity($quatity)
    ->setSku("123123") // Similar to `item_number` in Classic API
    ->setPrice($dola);
	$itemList = new ItemList();
$itemList->setItems(array($item1));
//Payer
$payer->setPaymentMethod("paypal");
$details->setShipping('0.00')
		->setTax('0.00')
	  ->setSubtotal($total);
//Amount
$amount->setCurrency('USD')
	   ->setTotal($total)
	   ->setDetails($details);
//Transaction
$transaction->setAmount($amount)
			->setItemList($itemList)
			->setDescription($descrip)
			->setInvoiceNumber($invo);
//Payment
$payment->setIntent('sale')
		->setTransactions([$transaction])
		->setPayer($payer);
		
//RedirectuRL
$redirectUrls-> setReturnUrl('http://localhost/pages/light/paypal/pay.php?approved=true')
			 ->setCancelUrl('http://localhost/pages/light/paypal/pay.php?approved=false');
$payment->setRedirectUrls($redirectUrls);
try{
	$payment->create($api);
	//echo 'works';
	//generate and store hash
	$hash=md5($payment->getId());
	//$_SESSION['paypal_hash']=$hash;
	setcookie('paypal_hash', $hash, time() + (86400 * 30), "/");
	$pay=$payment->getId();
	$sql2="
INSERT INTO [dbo].[Payment]
           ([Payment_ID]
           ,[Payment_Method]
           ,[Payment_Date]
           ,[Payer]
           ,[Invoice_ID]
           ,[Payment_Status]
		   ,[Hash])
     VALUES
           ('$pay'
           ,'paypal'
           ,getdate()
           ,'$cust'
           ,'$invo'
           ,0
		   ,'$hash')";
		   
		   
	$stmt2 = sqlsrv_query( $conn, $sql2 );
	if( $stmt2 === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql2;
        }
    }
}else
$message= '<div class="alert alert-success">Lead added Successfully</div>';
}catch( PayPal\Exception\PayPalConnectionException $ex)
{
	echo $ex->getData();
}
foreach($payment->getLinks() as $link){
	if($link->getRel()=='approval_url')
		$redirectUrl=$link->getHref();	
}
header('Location:'.$redirectUrl);
?>
