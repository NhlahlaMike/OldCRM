<?php
ob_start();
session_start();
error_reporting(0);
require "Config.php";

//getting number of New Opportunity leads

$sql_get_newOpportunity = "select s.Status_Name
from Status s, Customer c
where s.CustID = c.CustID
AND datename(mm, s.Status_Date) = 'February'
AND s.Status_Name = 'New Opportunity'";

 $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt1 = sqlsrv_query($conn, $sql_get_newOpportunity, $params, $options);
	 $num_newOpportunity =sqlsrv_num_rows($stmt1);
	 
	 $_SESSION['num_newOpportunity'] = $num_newOpportunity;

//getting number of Not Attempted leads datename(mm, GETDATE())
$sql_get_NotAttempted = "select s.Status_Name
from Status s, Customer c
where s.CustID = c.CustID
AND datename(mm, s.Status_Date) = 'February'
AND s.Status_Name = 'Not Attempted'";

 $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt2 = sqlsrv_query($conn, $sql_get_NotAttempted, $params, $options);
	 $num_notAtempted =sqlsrv_num_rows($stmt2);
	 
	$_SESSION['num_notAtempted'] = $num_notAtempted;
	
		//getting number of disqualified leads
	
$sql_get_disqualified = "select s.Status_Name
from Status s, Customer c
where s.CustID = c.CustID
AND datename(mm, s.Status_Date) = 'February'
AND s.Status_Name = 'disqualified'";

 $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt3 = sqlsrv_query($conn, $sql_get_disqualified, $params, $options);
	 $num_disqualified =sqlsrv_num_rows($stmt3);
	 
	$_SESSION['num_disqualified'] = $num_disqualified;
	 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard PieChart</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	  
      function drawChart() {  
        var data1 = google.visualization.arrayToDataTable([
         ['Status', 'Number of Customer Per Status'],
         ['New Opportunity', <?php echo $_SESSION['num_newOpportunity'] ?>],
         ['Not Attempted', <?php echo $_SESSION['num_notAtempted'] ?>],
		 ['Disqualified', <?php echo $_SESSION['num_disqualified'] ?>]
        ]);

        var options1 = {
			title: '',
		is3D: true,
	
           };


        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data1, options1);
		
      }
    </script>
</head>



<body>

<div id="piechart" style="width: 1500px; height: 750px;"></div>

<div style="margin-left: 45%">

<!-- <form action="ManagerViewLeadsPerSales.php" method="POST">
<input type="submit" name="Back" value="Back" >
</form> -->   
</div> 

</body>
</html>