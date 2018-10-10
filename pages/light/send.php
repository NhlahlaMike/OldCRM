<?php
ob_start();
session_start();
//include 'session.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

?>
<?php

//echo isset($_POST['fname']);


require "config.php";
$message='';
$prodID=$_POST['ProdType'];
$prodD=$_POST['ProdName'];
$prodPrice=$_POST['prodPrice'];
$custID=$_POST['fname'];
$leadID=$_POST['leadID'];
$inv=$_POST['invoice'];


 $sql2="INSERT INTO [dbo].[Lead]
           ([LeadID]
           ,[CustID]
           ,[Description]
           ,[Product]
           ,[Date_Created]
           ,[Prod_ID])
     VALUES
           ('$leadID'
           ,'$custID'
           ,''
           ,'$prodD'
           ,GetDate()
           ,'$prodID')
	 ";
//$params = array();
////$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
//$stmt = sqlsrv_query( $conn, $sql , $params, $options );
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
//header('Location:view_cusFull.php');




//insert invoice
$sql3="INSERT INTO [dbo].[Invoice]
           ([Invoice_ID]
           ,[I_Status]
           ,[Invoice_cost]
           ,[Additional_Costs]
           ,[AC_Description]
           ,[Lead_ID])
     VALUES
           ('$inv'
           ,'Not Yet Paid'
           ,$prodPrice
           ,'0.0'
           ,''
           ,'$leadID')";
		   $stmt4 = sqlsrv_query( $conn, $sql3 );
		   if( $stmt4 === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql3;
        }
    }
}



$update="UPDATE [dbo].[Status]
   SET [Status_Name] = 'New Opportunity',
    [Status_Date]=getdate()
 WHERE custID='$custID'";
 $stmt2 = sqlsrv_query( $conn, $update );
 if( $stmt2 === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql;
        }
    }
}


$mess='<div class="container">
  <h2>Invoice</h2>
              
  <table class="table table-condensed">
    <tbody>
      <tr>
        <td>Invoice ID</td>
        <td><input type="text" name="invoice" value="'.$inv.'" style="border: none" readonly></td>
      </tr>
      <tr>
        <td>lead ID</td>
        <td><input type="text" name="invoice" value="'.$leadID.'"  style="border: none" readonly></td>

      </tr>
      <tr>
        <td>Customer ID</td>
        <td><input type="text" name="invoice" value="'.$custID.'"  style="border: none" readonly></td>
      </tr>
	              <tr>
        <td>Product ID</td>
        <td><input type="text" name="invoice" value="'.$prodID.'" size="50px" style="border: none" readonly></td>
      </tr>
            <tr>
        <td>Product description</td>
        <td><input type="text" name="invoice" value="'.$prodD.'" size="50px" style="border: none" readonly></td>
      </tr>
            <tr>
        <td>Product Price</td>
        <td><input type="text" name="invoice" value="'.$prodPrice.'"  style="border: none" readonly></td>
      </tr>
    </tbody>
  </table>
</div>';
echo $mess;
//email part
//require "config.php";
$sql="SELECT * FROM dbo.customer where custid='$custID'";
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


		while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
		{
		
			
					
					$name=$row['Name'];
					$surname=$row['Surname'];
					$email=$row['Email'];
                                            
				
			
		}
		$data=$_SESSION['database'];
		
		$full_name=$name.' '.$surname;
		$text_message='<a href="http://localhost/pages/light/getref.php?ref='.$inv.'&comp='.$data.'" class="button">Click Here to confirm your Purchase</a>';
$message;

$text='<a href="http://localhost/pages/light/uploadAdmin.php?ref='.$inv.'
" class="button">Click Here to confirm your Purchase</a>';

  // HTML email starts here
   
   $message  = "<html> <head><style>.button {
    background-color: ##CCCC00;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> 
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'></head><body>";
   
   $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
   
   $message .= "<tr><td>";
   
   $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
    
   $message .= "<thead>
      <tr height='80'>
       <th colspan='4' style='background-color:#CCCC00; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >IKWORX</th>

      </tr>
      </thead>";
	  	     $message .= "<tbody>
			  <tr>
       <td colspan='4' style='padding:15px;'>
        <p style='font-size:20px;'>Hi ".$full_name.",</p>
        <hr />
		".$mess."
           <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>".$text_message."</p><br><br>
		   <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>".$text."</p>
		   
        <img src='https://4.bp.blogspot.com/-8RZhFSqg5sY/WnmnpMcfTnI/AAAAAAAAQBQ/K4Joy6pFXncx5IFMcoMlArdmMfRD7GoNgCLcBGAs/s320/godfrey.jpg'  alt='Please Upgrade your email client' title='Confirm Order' style='height:auto; width:100%; max-width:100%;' />
     
       </td>
      </tr>
		 
		
		 
		 
		 </tbody>";
    
  
   $message .= "</table>";
   
   $message .= "</td></tr>";
   $message .= "</table>";
   
   $message .= "</body></html>";


 $message;






//echo $message;
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function


//Load composer's autoloader
require '../vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
  //  $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'ashur.aserv.co.za';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'Calendar@ikworx.co.za';                 // SMTP username
    $mail->Password = 'Password@2018';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('demo@ikworx.co.za', 'Confirm Order');
    //$mail->addAddress('gntimba@gmail.com', 'Joe User');     // Add a recipient
    $mail->addAddress($email);               // Name is optional
    $mail->addReplyTo('demo@ikworx.co.za', 'Demo');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('docs/Advanced Electronic Documents and Records Management#3.pdf');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Veify order';
    $mail->Body    = $message;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<div class="alert alert-success">Email Successfully</div>';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>
<head>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> 
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
</head>


