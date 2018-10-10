 <?php
ob_start();
session_start();

require "Config.php";

$sql= "Select datename(MM,date_created) as date_created from dbo.Leads";

$stmt = sqlsrv_query($conn, $sql);

if(isset($_POST['submit'])){
   
    	
		while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
		{
			
			$Date_created=$row['date_created'];
			$leadscount = "select datename(MM, date_created) as date_created, count([Prod_ID]) as number_leads FROM [CRM_db].[dbo].[Lead] Oder by date_created";
		
		echo $leadscount;	
			
		}
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Pie Chart Pract</title>

<h1><center><font color="#110001"><b>Table in Graph Form</b></font></center></h1>
<hr>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	  
      function drawChart() {  
        var data1 = google.visualization.arrayToDataTable([
         ['Months', 'Number of Leads per month'],
         ['Target', <?php echo $_SESSION['targetno'] ?>,],
         ['Leads', <?php echo $_SESSION['num_leads'] ?>]

        ]);

        var options1 = {
			title: 'Pie Chart',
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