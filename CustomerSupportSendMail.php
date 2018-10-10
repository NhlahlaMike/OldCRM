  <?php 

//Customers send any queries to admin email

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['submit'])){
    $to = "Sbuda95@gmail.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $first_name = $_POST['first_name'];
	$message = $_POST['message']; //this is the message from the textarea
    $contact_number = $_POST['contact_number'];
	
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
    $mail->setFrom($from, $first_name);
    //$mail->addAddress('gntimba@gmail.com', 'Joe User');     // Add a recipient
    $mail->addAddress('Sbuda95@gmail.com');               // Name is optional
    //$mail->addReplyTo($from, $first_name);
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
    echo "Mail Sent. Thank you, " . $first_name . ", we will contact you shortly.";
    }
	
	
?>

<!DOCTYPE html>
<head>
<title>Send Question</title>
</head>
<body>


<form action="" method="post">
Name: <input type="text" name="first_name" placeholder="Enter your name" required><br>
<br>
Contact no: <input type="number" name="contact_number" placeholder="Cellphone number"><br>
<br>
Email: <input type="text" name="email" placeholder="Enter your email address"><br>
<br>
Message:<br><textarea rows="5" name="message" cols="30" placeholder="Type in a message..."></textarea><br>
<input type="submit" name="submit" value="Send Message">
</form>

</body>
</html> 