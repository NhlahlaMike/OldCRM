<?php
ob_start();
session_start();
include 'session.php';

?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



if(isset($_POST['submit'])){
	$invoiceMessage=$_SESSION['invoice'];
	$custid=$_SESSION['custid'];
require "config.php";
$sql="SELECT * FROM dbo.customer where custid='$custid'";
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
		
		$full_name=$name.' '.$surname;
		$text_message='<a href="192.168.176.50/crm/getref.php?ref='.$_SESSION['invNO'].'" class="button">Click Here to confirm your Purchase</a>';
$message;

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
</style> </head><body>";
   
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
		".$invoiceMessage."
           <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>".$text_message."</p>
        <img src='https://4.bp.blogspot.com/-8RZhFSqg5sY/WnmnpMcfTnI/AAAAAAAAQBQ/K4Joy6pFXncx5IFMcoMlArdmMfRD7GoNgCLcBGAs/s320/godfrey.jpg'  alt='Please Upgrade your email client' title='Confirm Order' style='height:auto; width:100%; max-width:100%;' />
     
       </td>
      </tr>
		 
		
		 
		 
		 </tbody>";
    
  
   $message .= "</table>";
   
   $message .= "</td></tr>";
   $message .= "</table>";
   
   $message .= "</body></html>";









//echo $message;
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function


//Load composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
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
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
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


}
?>



<!doctype html>
<html>
<head>
 <link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<meta charset="utf-8">
<title>email test</title>


</head>

<body>

</body>
</html>

