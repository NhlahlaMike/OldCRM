<?php
ob_start();
session_start();
$_SESSION['message']='';
require "config.php";



if (isset($_POST['submit'])){
$pass=$_POST['password'];
$user=$_POST['email'];
$user = stripslashes($user);
$pass = stripslashes($pass);
//$user = mysql_real_escape_string($user);
//$pass = mysql_real_escape_string($pass);

$sql="SELECT * FROM dbo.Sales_Rep WHERE S_Emails = '$user' and S_Password = '$pass'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
//$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false ) 
{
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql;
        }
	}
}
else if(sqlsrv_num_rows( $stmt )===1)
{
	//session_start();
        $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	$_SESSION['username']=$row['S_Emails'];
	$_SESSION['name']=$row['SalesID'];
        $_SESSION['Role']=$row['S_Role'];
        //echo $_SESSION['Role'];
        switch ($_SESSION['Role'])
        {
            case 'Manager';
                header('Location:SaleManagerHome.php');
            break;
            case 'Consultant';
                header('Location:Sales.php');
            break;
            case 'Team Leader';
                header('Location:TeamLeaderHome.php');
            break;
            case 'Admin';
                header('Location:AdminMenu.php');
            break;
        }

        
	//header('Location:sales.php');
	echo '';
	echo $row['SalesID'];
}
else
{
	
       $_SESSION['message'] =  '<div class="alert alert-error">Check Your Creditials</div>';
        
	
}

$sql1="SELECT * FROM Users WHERE User_email = '$user' AND User_Password = '$pass'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql1 , $params, $options );
if(sqlsrv_num_rows( $stmt )===1)
{
    	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	$_SESSION['Username']=$row['Username'];
	$_SESSION['Role']=$row['User_role'];
        header('Location:AdminHome.php');
}

}

    
?>

    <head>
        <meta charset="UTF-8"></meta>
       <title>LOGIN PAGE</title>
       
        <link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
    </head>
    
  <body >
<div class="container" ></div>
<div class="col-sm-20 col-md-8 col-lg-5" style="background-color:gray;">
<br><br><br>
    <h4>Login</h4>
    <br>
 <form class="form-horizontal" role="form" method="post" action ="<?php echo $_SERVER['PHP_SELF']; ?>">
   
    <div class="form-group">
        <label form="email" class="control-label col-sm-3">Email</label>
          <div class="col-sm-8">
              <input type="email"class="form-control "name="email" required placeholder="Enter email">
  </div>
     </div>
    <div class="form-group">
       <label for="pwd" class ="control-label col-sm-3">Password</label>
  <div class="col-sm-8">
       <input type="password" class="form-control" name="password" required placeholder="Enter password">
  </div>
     </div>
     <div class="col-sm-offset-2 col-sm-8"><br>
    <input type="submit" name="submit" class="btn btn-default">
    <?php    echo $_SESSION['message'];?>
    <br><br>
    <b><a  href="layout1/layout1/index.html">LOGOFF</a></b>
      <div class="col-sm-20 col-md-8 col-lg-5" style="background-color:green;">
    </div></form>
  </div>
 

</div>

</body> 

 
