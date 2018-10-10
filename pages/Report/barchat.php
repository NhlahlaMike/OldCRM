<html>
  <head>
    <!--Load the AJAX API-->
    <link href="table.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart','bar']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
      
    function drawChart() {
      var jsonData = $.ajax({
          url: "pay.php",
          dataType: "json",
          async: false
          }).responseText;
		    var options = {
          title: 'Paid Invoices',width: 700, height: 400
        };
		   var jsonData1 = $.ajax({
          url: "../getdata.php",
          dataType: "json",
          async: false
          }).responseText;
		    var options1 = {
          title: 'Check how many leads per Month',width: 700, height: 400
        };
		 function selectHandler() {
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
            var topping = data.getValue(selectedItem.row, 0);
            alert('The user selected ' + topping);
          }
        }
  
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);
	   var data1 = new google.visualization.DataTable(jsonData1);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('pay'));
	   google.visualization.events.addListener(chart, 'select', selectHandler);
      chart.draw(data ,options);
	  //
	   var chart = new google.visualization.PieChart(document.getElementById('how'));
      chart.draw(data1 ,options1);
    }

    </script>
      
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="pay" ></div>
    <div id="how"></div>
    <a href="../SaleManagerHome.php">Back</a> 
  </body>
</html>
