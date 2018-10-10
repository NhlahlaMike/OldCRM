<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Light Bootstrap Dashboard by ikworx</title>

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
    <div class="sidebar" data-color="green" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                   ikworx
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="dashboard.php">
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
                    <a href="table.php">
                        <i class="pe-7s-menu"></i>
                        <p>Sale menu</p>
                    </a>
                </li>
                <li>
                <a href="load.php">
                        <i class="pe-7s-upload"></i>
                        <p>Load customer</p>
                    </a>
                </li>
                <li>
                    <a href="manual.php">
                        <i class="pe-7s-id"></i>
                        <p>Manual</p>
                    </a>
                </li>
                <li>
                    <a href="viewedit.php">
                        <i class="pe-7s-note2"></i>
                        <p>view /edit customer</p>
                    </a>
                </li>
           
                 <li class="active">
                    <a href="viewleads.php">
                        <i class="pe-7s-albums"></i>
                        <p>view leads</p>
                    </a>
                </li>
                     <hr>
                <li>
                <li>
                    <a href="typography.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Typography</p>
                    </a>
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
				<li> 
                <i class="active-pro"></i>
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
                    <a class="navbar-brand" href="#">View leads</a>
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
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>
                                    <span class="notification hidden-sm hidden-xs">5</span>
									<p class="hidden-lg hidden-md">
										5 Notifications
										<b class="caret"></b>
									</p>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
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
                            <a href="#">
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <?php
//session_start();
$selected ='';
$Stselected='';
$NamesRecords='';


require "config.php";
$sql="SELECT * FROM dbo.Customer";
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql;
        }
    }
}

function get_options($select)
{
    $reports = array('Daily'=>1,'Weekly'=>2,'Monthly'=>3);
    
    $options = '';
    
    while(list($k,$v)= each($reports))
    {
        if($select==$v)
        {
            $options .='<option value="'.$v.'"selected>'.$k.'</option>';
        }
        else 
        {
            $options .='<option value="'.$v.'">'.$k.'</option>';
        }
        
    }
    
    return $options;
           
}

function get_status($Sselect)
{
    $status = array('Not Attempted'=>1,'Attempted'=>2,'Contacted'=>3,'Disqualified'=>4,'New Opportunity'=>5);
    
    $Soptions = '';
    
    while(list($ky,$va)= each($status))
    {
        if($Sselect==$va)
        {
            $Soptions .='<option value="'.$va.'"selected>'.$ky.'</option>';
        }
        else 
        {
            $Soptions .='<option value="'.$va.'">'.$ky.'</option>';
        }
        
    }
    
    return $Soptions;
            
}

function loadSalesNames()
   {  
            
    require "config.php";
    $message='';
    $sql= "select Name from dbo.Customer ";
    $stmt = sqlsrv_query( $conn, $sql );      
       $SalesMember = '';
       while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
           {  
               $SalesMember = $row["Name"];
               echo "<option value='".$SalesMember."'>".$SalesMember."</option>"; 				
           }
           $memberNames = $SalesMember;
           return $memberNames;           
    } 


if(isset($_SESSION['reports']) && isset($_SESSION['status']) && isset($_SESSION['AllSalesnames']))
{
   $url="leadsview.php";
   header('Location: '.$url);
   exit();
}
else if(isset($_POST['reports']) && isset($_POST['status']) && isset($_POST['AllSalesnames']))
{
    $selected = $_POST['reports'];
    $Stselected = $_POST['status'];
    $NamesRecords = $_POST['AllSalesnames'];
    echo $selected;
    echo $Stselected;
    echo $NamesRecords;
    $_SESSION['reports']= $selected;
    $_SESSION['status']= $Stselected;
    $_SESSION['AllSalesnames']=$NamesRecords;
    $url = "leadsview.php?reports=".$selected;
    $url = "leadsview.php?status=".$Stselected;
    $url = "leadsview.php?AllSalesnames=".$NamesRecords;
    header('Location:'.$url);
    exit();
}
   session_destroy();
   unset($_SESSION['reports']);
   unset($_SESSION['status']);
   unset($_SESSION['AllSalesnames']);
   
?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
      <link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
    <body> 
      <h5 align="center"><font  color="#cccc00" face="Segoe" size="+4">View Leads</font></h5>
        <form name ="seloption" action="<?php echo "$_SERVER[PHP_SELF]"; ?>"  method="POST">
            <div class="container"> 
            
            <select name="reports" value="Select">
            <?php echo get_options($selected); ?>
            </select><br><br>
            
            <select name="status" value="Select">
            <?php echo get_status($Stselected); ?>
            </select><br><br>
            
            <select name="AllSalesnames">
            <?php        
            loadSalesNames();
            ?>  <br><br>
            </select><br><br>
             <input type="submit" value="View Leads">
            <br>
            
            <a href="Sales.php">Back</a>
        </form>
   
    </body>
</html>


                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
                                    <thead>
                                        
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                </div>
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
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.ikworx.co.za">ikworx</a>, made with love for a better web
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
