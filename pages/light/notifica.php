<?php
ob_start();
session_start();
include 'configCookie.php';
$user=$_SESSION['name'];
$sql="SELECT * FROM notify where salesid='$user'  order by date_added desc ";
$stmt3 = sqlsrv_query( $conn, $sql );
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





?>


<!doctype html>
<html>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon1.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link  rel="stylesheet"href="../hover.css">

	<title>Notifications</title>

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
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<h1 style="width:600px;margin-left:200px">Notifications</h1>
<body style=" background-image:url(1.png)">
                        <div class="card " style="width:600px;margin-left:200px" >
                            <div class="header">
                                <h4 class="title">Tasks</h4>
                                <p class="category">Backend development</p>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>

                                            <?php
											 while( $row = sqlsrv_fetch_array( $stmt3,  SQLSRV_FETCH_BOTH) ) 
  {
	  echo '<tr>
 <td>

</td>
 <td><strong>'.$row['Title'].'</strong><br>'.$row['Comment'].'"</td>
                                               

                                            </tr>';
	  
  }
  
  ?>
											
                                        </tbody>
                                    </table>
                                </div>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i>Ikworx
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</body>
</html>
