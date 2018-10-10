<?php
ob_start();
session_start();
$name = $_POST['lblname']; $surname = $_POST['lblsurname']; $CustEmail = $_POST['txtEmail'];
$Phonenumber = $_POST['txtPhone']; $CustCompany = $_POST['txtCompany']; $Desg = $_POST['txtDesignation'];
$InvStatus = $_POST['txtI_Status']; $Prodname = $_POST['txtProd_Name']; $ProdDuration = $_POST['txtProd_Duration'];
$Prodprice = $_POST['txtProd_Price']; 

?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
<fieldset>
<body bgcolor="silver">

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<link href="table.css" rel="stylesheet" type="text/css">
<fieldset>
<legend><h5 align="center"><font  color="red" face="Segoe" size="+6">Case Information </font></h5></legend>
        
        <form name ="seloption" action="CaseProgressBar.php"  method="POST"> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3>Overall Customer information</h3>
            &nbsp;&nbsp;&nbsp;&nbsp;<font color="Nevy" size="3"><label>Name: <?php echo $name ?> </label><br>
            &nbsp;&nbsp;&nbsp;&nbsp;<font color="Nevy" size="3"><label>Surname: <?php echo $surname ?> </label><br>
            &nbsp;&nbsp;&nbsp;&nbsp;<font color="Nevy" size="3"><label>Phone Number: <?php echo $Phonenumber  ?> </label><br>
            &nbsp;&nbsp;&nbsp;&nbsp;<font color="Nevy" size="3"><label>Email: <?php echo $CustEmail ?> </label><br>
            &nbsp;&nbsp;&nbsp;&nbsp;<font color="Nevy" size="3"><label>Company: <?php echo $CustCompany ?> </label><br>
            &nbsp;&nbsp;&nbsp;&nbsp;<font color="Nevy" size="3"><label>Designation: <?php echo $Desg ?> </label><br>
            &nbsp;&nbsp;&nbsp;&nbsp;<font color="Nevy" size="3"><label>Payment Status: <?php echo $InvStatus ?> </label><br>
            &nbsp;&nbsp;&nbsp;&nbsp;<font color="Nevy" size="3"><label>Product Name: <?php echo $Prodname ?> </label><br>              
            &nbsp;&nbsp;&nbsp;&nbsp;<font color="Nevy" size="3"><label>Product Duration: <?php echo $ProdDuration ?> </label><br>
            &nbsp;&nbsp;&nbsp;&nbsp;<font color="Nevy" size="3"><label>Product Price: <?php echo $Prodprice ?> </label><br>
        </form>
        
</fieldset> 
<a href="light/dashboard1.php">Back</a>  
    </body>
</html>