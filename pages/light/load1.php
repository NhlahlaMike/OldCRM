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
    
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                    <a href="Admin.php">
                        <i class="pe-7s-menu"></i>
                        <p>Admin home</p>
                    </a>
                </li>
          <li class ="active"> 
         
                <a href="load1.php">
                        <i class="pe-7s-upload"></i>
                        <p>Import</p>
                    </a>
                </li>
                <li> 
                    <a href="confirmInv.php">
                        <i class="pe-7s-id"></i>
                        <p>Confirm invoice</p>
                    </a>
                </li>
                
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
                    <a class="navbar-brand" href="#">Import</a>
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
                           <a href="#">
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
            <?php
			
		
			
$sales=$_SESSION['name'];
require_once "..\classes\PHPExcel.php";

require "..\config.php";

//using file upload
if(empty($_FILES))
{
    echo"
    <form method='post' enctype='multipart/form-data' action='load.php'>
    <input type='file' name='excel' accept='.xls, .xlsx'>
    <br>
    <button type='submit'>Load</button>
    </form>";
}
else{
    //load excel file using PHPExcell
$excel=PHPExcel_IOFactory::load($_FILES['excel']['tmp_name']);
$excel->setActiveSheetIndex(0);
//determines which row the data series start
 $i=2;

//loop until the end of the series
while ($excel->getActiveSheet()->getCell('A'.$i)->getValue()!=""){
    //get  cells value
   // $Row_id=$excel->getActiveSheet()->getCell('A'.$i)->getValue();
//$order_id=$excel->getActiveSheet()->getCell('B'.$i)->getValue();
   // $order_date=$excel->getActiveSheet()->getCell('C'.$i)->getValue();
	//converting Excel date format to a formatted and readable
   // $order_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP((int)$order_date));
$name=$excel->getActiveSheet()->getCell('A'.$i)->getValue();
$surname=$excel->getActiveSheet()->getCell('B'.$i)->getValue();
$email=$excel->getActiveSheet()->getCell('C'.$i)->getValue();
$company=$excel->getActiveSheet()->getCell('E'.$i)->getValue();
$designation=$excel->getActiveSheet()->getCell('F'.$i)->getValue();
$phone=$excel->getActiveSheet()->getCell('D'.$i)->getValue();
$addr1=$excel->getActiveSheet()->getCell('G'.$i)->getValue();
$city=$excel->getActiveSheet()->getCell('H'.$i)->getValue();
$province=$excel->getActiveSheet()->getCell('K'.$i)->getValue();
$zip=$excel->getActiveSheet()->getCell('I'.$i)->getValue();
$country=$excel->getActiveSheet()->getCell('K'.$i)->getValue();

    //$name=$excel->getActiveSheet()->getCell('G'.$i)->getValue();
$sql1= "select CustID from dbo.customer";
$stmt1 = sqlsrv_query( $conn, $sql1 );

	while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) 
		{
			$temp= explode("C",$row['CustID']);
			
		}
		$temp[1]+=1;
		$num = 123;
$str_length = 3;

// hardcoded left padding if number < $str_length
$custID= substr("0000{$temp[1]}", -$str_length);

// output: 0123
		
		//$custID="C".$temp[1];
		 $custID="C".$custID;
		 
$phone='0'.$phone;
$sql="INSERT INTO [dbo].[Customer]
           ([CustID]
           ,[Name]
           ,[Surname]
           ,[Email]
           ,[Phone]
           ,[Company]
           ,[Address]
           ,[City]
           ,[Zip_code]
           ,[Province]
           ,[Country]
           ,[Date_Added]
           ,[SalesID]
		   ,[Designation])
     VALUES
           ('$custID'
           ,'$name'
           ,'$surname'
           ,'$email'
		   ,'$phone'
           ,'$company'
           ,'$addr1'
           ,'$city'
           ,'$zip'
           ,'$province'
		   ,'$country'
		   ,GetDate()
		   ,'$sales'
		   ,'$designation')
	 ";
//$params = array();
////$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
//$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false ) {
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
$sql2= "select StatusID from dbo.status";
$stmt2 = sqlsrv_query( $conn, $sql2 );

	while( $row = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) 
		{
			$temp= explode("ST",$row['StatusID']);
			
		}
	$num=	(int)$temp[1];
$num+=1;
		
$str_length = 3;

// hardcoded left padding if number < $str_length
$StatusID= substr("0000{$num}", -$str_length);

// output: 0123
		
		//$custID="C".$temp[1];
		  $StatusID="ST".$StatusID;
		 
$sql3="INSERT INTO [dbo].[Status]
           ([StatusID]
           ,[CustID]
           ,[Status_Name]
           ,[Status_Date])
     VALUES
           ('$StatusID'
           ,'$custID'
           ,'Not Attempted'
           ,getdate())";
		   $stmt3 = sqlsrv_query( $conn, $sql3 );
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

$i++;

}
echo $message= '<div class="alert alert-success">Upload Success</div>';

}

?>
<br>
	<form>

		<button formaction="Exportcust.php" class="btn btn-primary">Export Customers</button>
        
       
        </form>
        <br>
        <br>
        	<form>

		<button formaction="Exportleads.php" class="btn btn-primary">Export leads</button>
        
        <br><br>
         <a href="Admin.php">Back</a>
        </form>
        
        
	
	    
	<div class="row">
	    <div class="modal fade" id="export-modal" tabindex="-1" role="dialog">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button> 
                        
	                    <h4 class="modal-title">Options</h4>
	                </div>
	                <div class="modal-body">
	                    <p>How would you like to export?</p>
                        <a href="../AddProd.php" class="btn btn-primary" role="button">Excel</a>
	                    <button type="button" formaction="ExportCust.php" class="btn btn-primary">Excel</button>
                   
	                    <button type="button" class="btn btn-success">PDF</button>	</form>		    
<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<script>

    var dataTable = $('#example').DataTable({
        "sDom": "<'exportOptions text-right'B><'table-responsive't><'row'<p>>",
       	"scrollCollapse": true,
        "paging": true,
        // "bSort": true,
        "info": false,

        buttons: [ 
  
        	{
                extend:    'excelHtml5',
                text:      'Excel',
                className: 'btn btn-primary',
                title: 'Data export',
                // titleAttr: 'Export all rows to Excel file',
            },

            {
                extend:    'pdfHtml5',
                text:      'PDF',
                className: 'btn btn-primary',
                orientation: 'landscape',
                title: 'Data export',
                // titleAttr: 'Export all rows to PDF file',
                // pageSize: 'LEGAL'

            },

            {
                extend:    'copyHtml5',
                text:      'Copy Data',
                className: 'btn btn-primary',
                // titleAttr: 'Copy all rows to clipboard',
            },
		],

    });

</script>

</html>
