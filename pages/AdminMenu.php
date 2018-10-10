<?php
ob_start();
session_start();
//include 'session.php';

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">

<link href="stylex.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<title>Sales</title>
<div class="alert alert-success">You succesfully logged <?php echo $_SESSION['username'];?></div>
<h5 align="center"><font  color="#cccc00" face="Segoe" size="+4">Admin Home</font></h5>
</head>


<body>
<div align="center" class="one-third">
<h3><font  color="#eff0f2 "face="Segoe" size="+2">What do you want to do?</font></h3>

<div align="center" class="cake">
<br><br>
<form action="Excel.php">
  <p><input type="submit"  value="Load customer file" class="asbestos-flat-button">
</p>
</form>
<br>
<form action=".php">
<p><input type="submit" value="Confirm Invoice" class="asbestos-flat-button">
</p></form>

    
</p></form>
<a href="index.php">Back to login</a> 
</div>
</div>
        
        
        
</body>
</html>
