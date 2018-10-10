    <?php
ob_start();
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
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
 
	<title>Light Bootstrap Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
<link  rel="stylesheet"href="../hover.css">

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
        <script type="text/javascript">
     google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {  

		var jsonData = $.ajax({
			url:"getdataDashBarGraph.php",
			dataType:"json",
			async:false}).responseText;
			
			var data = new google.visualization.DataTable(jsonData);
			
        var options = {
          chart: {
            title: 'Customer Leads', 
            subtitle: 'Leads for: 2018',
			
          }
		  
        };

       var chart = new google.charts.Bar(document.getElementById('piechart1'));

       chart.draw(data, google.charts.Bar.convertOptions(options));
     

	 }
    </script>
 <!--Area chart script-->
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
          hAxis: {title: 'Status',  titleTextStyle: {color: '#000000'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="green" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.ikworx.co.za" class="simple-text">
                    ikworx
                    
                    
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="dashboard1.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li> 
                <hr>
            
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<div class="dropdown">
 <button class="dropbtn"><i class="pe-7s-menu"></i>Team leader menu</button>
  <div class="dropdown-content">
  
                  
                 
  </button>
  
  
   <li role="presentation" class="dropdown-header"><i class="pe-7s-menu"></i>Team leader Menu</i></li>
      <role="presentation" class="divider">
       <a href="ADDSALE.php"><i class="pe-7s-upload"></i>Add sales</a>
      <a href="REMOVE.PHP"><i class="pe-7s-id"></i>Delete Sales</a>
      <a href="CALENDERS.php"><i class="pe-7s-note2"></i>Monitor calender</a>
     
    <li role="presentation" class="divider"></li>
 <li role="presentation" class="dropdown-header"><i class="pe-7s-menu"></i>Sales Menu</i></li>
      <li role="presentation" class="divider"></li>
      <a href="load.php"><i class="pe-7s-upload"></i>Import</a></li>
      <a href="manual.php"><i class="pe-7s-id"></i>Manual</a></li>
      <a href="viewedit.php"><i class="pe-7s-note2"></i>View/Edit Customers</a></li>
      <a href="viewleads.php"><i class="pe-7s-albums"></i>View Leads</a></li>
  </li>
  </div>
</div>
</div>
</body>

<br><br><br><br>
    <hr>
   
                </li>
                <li>
                    <a href="icons.php">
                        <i class="pe-7s-science"></i>
                        <p>Icons</p>
                    </a>
                </li>
                <li>
                    <a href="maps.php">
                        <i class="pe-7s-map-marker"></i>
                        <p>Maps</p>
                    </a>
                </li>
                <li>
                    <a href="notifications.php">
                        <i class="pe-7s-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>
				<li class="active-pro">
                    <a href="upgrade.php">
                        <i class="pe-7s-rocket"></i>
                        <p>Upgrade to PRO</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Team leader Menu</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
								<p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        
                       <li class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="pe-7s-bell" style="font-size:23px;"></span></a>
       <ul class="dropdown-menu"></ul>
      </li>
      <input type="hidden" id="sale" value="<?php echo $_SESSION['name']; ?>">
  <script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
	 var value = $("#sale").val();
  $.ajax({
   url:"fetch.php?field="+value,
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
$(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
								<p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                     <li>
                           <a href="AboutUs3.php">
                               <p>About Us</p>
                            </a>
                    
                        <li>
                           <a href="">
                               <p>Account</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
										Dropdown
										<b class="caret"></b>
									</p>

                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="login.php">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>


      <div class="content" >
            <div class="container-fluid">
                <div class="row" style="width: 1550px; height: 250px;">
                    <div class="col-md-4">
                        <div class="card">

                            <div class="header" >
                                <h4 class="title">MonthlyReports</h4>
                                <p class="category">Last Campaign Performance</p>
                            </div >
                            <div class="content" >
  <div id="piechart" style="width: 450px; height: 250px;">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                <div class="row" style="width: 1350px; height: 250px;">
                    <div class="col-md-4">
                        <div class="card">

                            <div class="header" >
                                <h4 class="title">MonthlyReports</h4>
                                <p class="category">Last Campaign Performance</p>
                            </div >
                            <div class="content" >
<div id="chart_div" style="width: 350px; height: 250px;">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>               
                    
                    
                    
                    
                    

                    <div class="col-md-8" style="width: 980px; height: 150px;">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"></h4>
                             
                            </div>
<div id="piechart1" class="ct-chart ct-perfect-fourth"></div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Updated 3 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



               
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>


</body>

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

</html>

 <input type="hidden" id="sale" value="<?php echo $_SESSION['name']; ?>">
 <script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
	 var value = $("#sale").val();
  $.ajax({
   url:"fetch.php?field="+value,
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
$(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>




