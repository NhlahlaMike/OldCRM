<?php

require "Config.php";

$sql= "select Prod_Name from dbo.Product";
$stmt = sqlsrv_query( $conn, $sql);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//include('session.php');

if(isset($_POST['submit'])){
    $to = "sbuda95@gmail.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $name = $_POST['name'];
	$cellphone = $_POST['cellphone'];
	$email = $_POST['email'];
	$invoice = $_POST['invoice'];
	$product = $_POST['products'];
	$message = $_POST['message']; //this is the message from the textarea
    $contact_number = $_POST['contact_number'];
	
	//customer details on the email

$customerdetails ='<div class="container">
  <h2>Customer Complaint </h2>
              
  <table class="table table-condensed">
    <tbody>
      <tr>
        <td>Customer Name: </td>
        <td><input type="text" name="name" value="'.$name.'" style="border: none" readonly></td>
      </tr>
      <tr>
        <td>Cellphone: </td>
        <td><input type="number" name="cellphone" value="'.$cellphone.'"  style="border: none" readonly></td>

      </tr>
      <tr>
        <td>Email: </td>
        <td><input type="text" name="email" value="'.$email.'"  style="border: none" readonly></td>
      </tr>
	              <tr>
        <td>Invoice number: </td>
        <td><input type="text" name="invoice" value="'.$invoice.'" size="50px" style="border: none" readonly></td>
      </tr>
	          <td>Product: </td>
        <td><input type="text" name="product" value="'.$product.'" size="50px" style="border: none" readonly></td>
      </tr>
	          <td>Message: </td>
        <td><input type="text" name="message" value="'.$message.'" size="50px" style="border: none" readonly></td>
      </tr>
    </tbody>
  </table>
</div>';
echo $customerdetails;
	
	//Load composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'ashur.aserv.co.za';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'Calendar@ikworx.co.za';                 // SMTP username
    $mail->Password = 'Password@2018';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($from, $name);
    //$mail->addAddress('gntimba@gmail.com', 'Joe User');     // Add a recipient
    $mail->addAddress('sbuda95@gmail.com');               // Name is optional
    //$mail->addReplyTo($from, $first_name);
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Veify order';
    $mail->Body    = $customerdetails;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<div class="alert alert-success">Email Successfully</div>';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
    echo "Mail Sent. Thank you, " . $name . ", we will contact you shortly.";

}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form action="" method="POST">
Name: <input type="text" name="name" placeholder="Enter your name">
<br>
<br>
Cellphone number: <input type="number" name="cellphone" placeholder="Enter your cellphone number">
<br>
<br>
Email: <input type="text" name="email" placeholder="Enter your eamil address">
<br>
<br>
Invoice number: <input type="text" name="invoice" placeholder="Enter the invoice number">
<br>
<br> 
Select Product: <select name="products" style="width: 200px;" >
<br>
<br>	
<?php
//selects types of products from the database

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
	echo'<option value="'.$row['Prod_Name'].'">'.$row['Prod_Name'].'</option>';
	}
	//end of select
?>
</select><br>
<br>
Reason for complaint:<br><textarea rows="5" name="message" cols="40" placeholder="Type in a message...">
</textarea><br>
<input type="submit" name="submit" value="Send complaint">
</form>
</body>
</html>