<?php
ob_start();
session_start();
include 'sessNosale.php';

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">

<link href="stylex.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<title>Team Leader</title>
<div class="alert alert-success">You succesfully logged <?php echo $_SESSION['username'];?></div>
<h5 align="center"><font  color="#cccc00" face="Segoe" size="+4">Team Leader Home</font></h5>
</head>


<body>
<div align="center" class="one-third">
<h3><font  color="#eff0f2 "face="Segoe" size="+2">What do you want to do?</font></h3>

<div align="center" class="cake">
<br><br>
<form action="AddSalesMember.php">
  <p><input type="submit"  value="Add Sales Member" class="asbestos-flat-button">
</p>

<br>
</form>
<form action="DeleteSalesMember.php">
<p><input type="submit" value="Delete Sales Member" class="asbestos-flat-button">
</p></form>
<br>
<form action="calender.html">
<p><input type="submit" value="Monitor Calender" class="asbestos-flat-button">
</p></form>

   
</p></form>
<a href="logout.php">Back to login</a> 
</div>
</div>
        
        
        
</body>
</html>
