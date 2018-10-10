<?php
ob_start();
session_start();
include 'session.php';

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
<h5 align="center"><font  color="#cccc00" face="Segoe" size="+4">Sales Menu</font></h5>
</head>


<body>
<div align="center" class="one-third">
<h3><font  color="#eff0f2 "face="Segoe" size="+2">What do you want to do?</font></h3>

<div align="center" class="cake">
<br><br>
<form action="excel.php">
  <p><input type="submit"  value="Load Customer" class="asbestos-flat-button">
</p>
</form>
<form action="Reg_Page.php">
<p><input type="submit" value="Manual" class="asbestos-flat-button">
</p></form>
<form action="view_cusFull.php">
<p><input type="submit" value="View/Edit Customer" class="asbestos-flat-button">
</p></form>
<form action="index%20(2).php">
<p><input type="submit" value="View Lead" class="asbestos-flat-button">
 
    
</p></form>
<a href="logout.php">Back to login</a> 
</div>
</div>
        
        
        
</body>
</html>
