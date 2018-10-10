<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
     google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {  

		var jsonData = $.ajax({
			url:"getdatafromleads.php",
			dataType:"json",
			async:false}).responseText;
			
			var data = new google.visualization.DataTable(jsonData);
			
        var options = {
          chart: {
            title: 'View Leads', 
            subtitle: 'Leads for: 2018',
			
          }
		  
        };

       var chart = new google.charts.Bar(document.getElementById('piechart'));

       chart.draw(data, google.charts.Bar.convertOptions(options));
     

	 }
    </script>

</head>
<body >
<!-- background="black-background (6).jpg" -->
<div id="piechart" style="width: 1200px; height: 500px;"></div>
</body>
</html>