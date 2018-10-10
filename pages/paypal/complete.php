
<?php session_start();?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Payment complete</title>
 <link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/bootstrap.min.js"></script>
</head>
<p>Thank you for Paying For Future Reference Please Use Payment ID '<?php echo $_SESSION['payment'];?>' and Invoice '<?php echo $_SESSION['inv'];?>' </p>


<body>
</body>
</html>
