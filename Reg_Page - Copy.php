<!DOCTYPE html>
<html>
<head>
 <link href="stylesheet.css" rel="stylesheet" type="text/css">
 <link href="stylesheet.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<fieldset>

<title> Customer Registration</title>
</head>
<h5 align="center"><font  color="#FF0004" face="Segoe" size="+6">Customer Registration</font></h5>
<div class="container">  
<a href="Sales.html">Back menu</a > 
<form id="contact" action="success.html" method="post">
Name
<input placeholder="Name" type="text"  required autofocus >
<br><br>
Surname
<input placeholder="Surname" type="text"  required >
<br><br>
Email Address*
<input type="email" name="email" required placeholder="Enter email address">
<br><br>
Company *
<input placeholder="Company" type="text"  required >
<br><br>
Position *
<input placeholder="Position" type="text"  required >
<br><br>
Phone*
<input placeholder="Enter phone number" type="text" pattern="[0-9]{10}"/>
<br><br>
ID Address Line1 *
<input placeholder="Address line 1" type="text"  required >
<br><br>
City Line2 *
<input placeholder="City" type="text"  required >
<br><br>
Province*
<input placeholder="Province" type="text" required >
<br><br>
(Zip)*
<input placeholder="Zip*" type="text"  required >
<br><br>
<label>
 Comment:
<br>
<textarea name="comment" rows="5" cols="100" placeholder="Type in a comment..."></textarea>
<br><br><br><br><br><br>
<button type="submit"> Submit Client</button></label>
</form>
</div>
</fieldset>
</body>
