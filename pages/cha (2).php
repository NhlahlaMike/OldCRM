<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">

	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<script type="text/javascript" src="https://wwww.qstatic.com/charts/loader.js"></script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />


<title>Untitled Document</title>
</head>


<h4><small>Public Preferences</small></h4>

<div class="row margin-top">

 <div class="col-md-10 col-md-offset-1">

     <div id="chartPreferences" class="ct-chart "></div>

 </div>

</div>

<div class="row">

 <div class="col-md-10 col-md-offset-1">

     <h6>Legend</h6>

     <i class="fa fa-circle text-info"></i> Apple

     <i class="fa fa-circle text-success"></i> Samsung

     <i class="fa fa-circle text-warning"></i> BlackBerry

     <i class="fa fa-circle text-danger"></i> Windows Phone

 </div>

</div>
</script>
   <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
<script>


<!-- javascript -->

var dataPreferences = {
	series: [
		[25, 30, 20, 25]
	]
};

var optionsPreferences = {
	donut: true,
	donutWidth: 40,
	startAngle: 0,
	total: 100,
	showLabel: false,
	axisX: {
		showGrid: 
	}
};

Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);

Chartist.Pie('#chartPreferences', {
  labels: ['62%','32%','6%'],
  series: [62, 32, 6]
});



</html>