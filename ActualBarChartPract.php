<?php


require "Config.php";

$sql= "Select datename(MM,date_created) as date_created from dbo.Leads";

$stmt = sqlsrv_query($conn, $sql);

if(isset($_POST['submit'])){
   
    	
		while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
		{
			
			$Date_created=$row['date_created'];
			$leadscount = "select datename(MM, date_created) as date_created, count([Prod_ID]) as number_leads FROM [CRM_db].[dbo].[Lead] Oder by date_creatd";
		
		echo $leadscount;	
			
		}
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {  
        var data = google.visualization.arrayToDataTable([
         ['Months', 'Number of Leads per month'],
         ['January', 5],
         ['February', 50],
         ['March', 6],
         ['April', 30],
		 ['May', 64],
		 ['June', 20],
		 ['July', 15],
		 ['August', 53],
		 ['September', 45],
		 ['October', 28],
		 ['November', 15],
		 ['December', 55]
        ]);

        var options = {
          chart: {
            title: 'View Leads',
            subtitle: 'Leads for: 2018',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

<body background="black background (6).JPEG">
<div id="columnchart_material" style="width: 800px; height: 500px;"></div>


</body>
</html>