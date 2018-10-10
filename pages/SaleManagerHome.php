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
<title>Sales</title>
<div class="alert alert-success">You succesfully logged <?php echo $_SESSION['username'];?></div>
<h5 align="center"><font  color="#cccc00" face="Segoe" size="+4">Sales Manager Home</font></h5>
</head>


<body>
<div align="center" class="one-third">
<h3><font  color="#eff0f2 "face="Segoe" size="+2">What do you want to do?</font></h3>

<div align="center" class="cake">
<br><br>
<form action="getdataleads.php">
  <p><input type="submit"  value="Leads Report" class="asbestos-flat-button">
</p>
</form>
<form action="report/barchat.php">
<p><input type="submit" value="View Invoicing Reports" class="asbestos-flat-button">
</p></form>
<form action="AddProd.php">
<p><input type="submit" value="Add Product Range" class="asbestos-flat-button">
</p></form>
<form action="PhpCaseReport.php">
<p><input type="submit" value="Case Reports" class="asbestos-flat-button">
 
    
</p></form>
<a href="logout.php">Back to login</a> 
</div>
</div>
        
        
        
</body>
</html>
