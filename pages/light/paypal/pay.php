<?php
session_start();
use PayPal\api\Payment;
use PayPal\api\PaymentExecution;
require "../getref.php";
require '../configCookie.php';
//$invo=$_SESSION['invoice'];
$paypal_hash=$_COOKIE['paypal_hash'];
if(isset($_GET['approved'])){
	$approved=$_GET['approved']==='true';
	if($approved){
		 $payer_id=$_GET['PayerID'];
		 
		//get payment id
		$sql="Select * from payment where Hash='$paypal_hash'";
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
		{
		
			 echo $paymenID=$row['Payment_ID'];
			 echo $invo=$row['Invoice_ID'];
			
		}
		
		try{
		$payment=Payment::get($paymenID,$api);
		$execution=new PaymentExecution();
		$execution->setPayerId($payer_id);
		$payment->execute($execution,$api);
		
			//payment complete
		$updatePay="update payment 
					set [Payment_Status] =1
					where hash='$paypal_hash'";
		$stmt0 = sqlsrv_query( $conn, $updatePay );

		//update the invoice statement
		$updateInvoice= "update invoice
						set [I_Status]='Payed'
						where [Invoice_ID]='$invo'";
		$stmt1 = sqlsrv_query( $conn, $updateInvoice );
		if( $stmt1 === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $updateInvoice;
        }
    }
}
		$_SESSION['payment']=$paymenID;
		$_SESSION['inv']=$invo;
		header('Location:complete.php');
	
		
		unset($_SESSION['paypal_hash']);
		
		}catch(PayPal\Exception\PayPalConnectionException  $ex){
			echo $ex->getData();
		}
					
		
		
	}else{
		header('Location:../paypal/cancelled.php');
	}
	
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Payment Status</title>
</head>

<body>
</body>
</html>
