<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">

      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#section1">Home</a></li>
        <li><a href="#section2">User Profile</a></li>
        <li><a href="#section3">Sales Menu</a></li>
		 <div class="btn-group user-helper-dropdown">
                        <div class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Sales Menu</div>
                        <ul class="dropdown-menu pull-">
                          
                            <li><a href="javascript:void(0);"><i class="material-icons"></i>Load Customer</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons"></i>Manual</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons"></i>View/Edit Customer</a></li>
							<li><a href="javascript:void(0);"><i class="material-icons"></i>View Leads</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons"></i>Sign Out</a></li></ul>
							</div>
		<li><a href="#section3">Notification</a></li>
		<li><a href="#section3">Map</a></li>					
		<li><a href="#section3">Charts</a></li>
		<li><a href="#section3">Calender</a></li>
      </ul><br>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search ..">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </div>

    <div class="col-sm-9">
	
      <h4><small>RECENT POSTS</small></h4>
	  <div class="navbar-header">
	  <hr>
     <div id="piechart"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'month per year'],
  ['january', 1],
  ['february', 19],
  
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'How many leads Per month', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
<hr>

</div>
</body>
</html>
