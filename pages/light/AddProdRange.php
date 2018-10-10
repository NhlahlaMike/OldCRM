
<!doctype html>
<html lang="en">
<head>
<?php
ob_start();
session_start();
//This will the admin to enter new products into the database 

require"config.php";
$mess='';
	if(isset($_POST['load'])){
	
	$prod_name = $_POST['prod_name'];
	$prod_desc = $_POST['prod_desc'];
	$prod_price = $_POST['prod_price'];
	
	
	$sql1= "select prod_id from dbo.Product";

$stmt1 = sqlsrv_query( $conn, $sql1);
	while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) 
		{
			$temp= explode("P",$row['prod_id']);
			
		}
		$temp[1]+=1;
		$str_length = 3;

// hardcoded left padding if number < $str_length
$prod_id= substr("0000{$temp[1]}", -$str_length);

		//$Prod_ID="P".$temp[1];
		 $prod_id="P".$prod_id;
	
	//adding products in the database
	$sql = "Insert into product(prod_id, prod_name, [Prod_Duration], prod_price)
		values('$prod_id','$prod_name', '$prod_desc', '$prod_price')";
	
	$stmt3 = sqlsrv_query( $conn, $sql);
	if( $stmt3 === false ) {
if( ($errors = sqlsrv_errors() ) != null) {
 foreach( $errors as $error ) {
     echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
     echo "code: ".$error[ 'code']."<br />";
     echo "message: ".$error[ 'message']."<br />";
     echo $sql;
     die;
 }
 }
}
$mess='<div style="width:300px" class="alert alert-success">Product has been Added </div>';
}
?>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Sales manager Menu</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


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
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="green" data-image="assets/img/sidebar-5.jpg" height="100px">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    Sales manager menu
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="../dashboard.php">
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
                 <li>
                    <a href="dashboard1.php">
                        <i class="pe-7s-menu"></i>
                        <p>Sale manager menu</p> 
                      </a>    
                  <li>
                <li >
                    <a href="leadsrep.php">
                        <i class="pe-7s-note2"></i>
                        <p>Leads report</p>
                    </a>
                </li>
                <li>
                 <a href="viewinvoice.php">
                        <i class="pe-7s-cash"></i>
                        <p>invoicing report</p>
                        </a>
                        </li>
                  <li class="active">
                     <a href="AddProdRange.php">
                        <i class="pe-7s-note"></i>
                        <p>Add product Range</p> 
                      </a>  
                      </li>  
                  <li>
                     <a href="casereport.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Case reports</p>        
                             
                    </a>
                     <a href="ViewPerSales.php">
                        <i class="pe-7s-id"></i>
                        <p>Leads per-sales</p>
                    </a>
                </li>
                
                
                <li>
                     <a href="task.php">
                        <i class="pe-7s-users"></i>
                        <p>Tasks per-sales</p>       
                              
                    
                </li>
                <hr>
                
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
                    <a class="navbar-brand" href="#">Add product Range</a>
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
                        </li>
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
								<p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
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
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid"> 
            <link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>

<fieldset>
<legend><h5 align="center"><font  color="#cccc00" face="Segoe" size="+6">Add Products Range</font></h5></legend>
<div class="container"> 


<form action="" method="post">


Product Name:<br> <input type="text" name="prod_name" placeholder="Product Name" required>
<br>

Product Duration: <br><input type="text" name="prod_desc" placeholder="Product Duration" required>
<br>

Product Price: <br><input type="text" name="prod_price" placeholder="Product Price" required>
<br>
<br>
<button type="submit" name="load">Load product</button><br>
<a href="Dashboard1.php">Back </a> 
</form>
<?php echo $mess;?>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">CRM</a>, made with love for a better web
                </p>
            </div>
        </footer>


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
