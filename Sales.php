<?php
ob_start();
session_start();
//include 'session.php';

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<title>Sales</title>
<div class="alert alert-success">You succesfully logged <?php echo $_SESSION['username'];?></div>
<h5 align="center"><font  color="#FF0004" face="Segoe" size="+4">Sales Menu</font></h5>
</head>


<body>
<div align="center" class="one-third">
<h3>What do you want to do?</h3>
<div align="center" class="cake">
    <form action="Reg_Page.php">
<p><input type="submit"  value="Load Customer" class="carrot-flat-button">
</p>
</form>
<form action="test.php">
<p><input type="submit" value="Manual" class="carrot-flat-button">
</p></form>
<form action="view_cusFull.php">
<p><input type="submit" value="View/Edit Customer" class="carrot-flat-button">
</p></form>
<form action="customer.html">
<p><input type="submit" value="View Lead" class="carrot-flat-button">
</p></form>
</div>
</div>
        
        
        
</body>
</html>
