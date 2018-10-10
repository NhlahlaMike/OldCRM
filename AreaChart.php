<?php
ob_start();
session_start();
error_reporting(0);
require "ConfigCookie.php";

//getting number of New Opportunity leads datename(mm, GETDATE())

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

//getting number of Not Attempted leads
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

 <html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
		['Status', 'Number of Customer Per Status'],
         ['New Opportunity', <?php echo $_SESSION['num_newOpportunity'] ?>],
         ['Not Attempted', <?php echo $_SESSION['num_notAtempted'] ?>],
		 ['Disqualified', <?php echo $_SESSION['num_disqualified'] ?>]
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Status',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
  </body>
</html>