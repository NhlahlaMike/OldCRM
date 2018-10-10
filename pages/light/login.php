<?php
ob_start();
session_start();
$_SESSION['message'] = '';


$conn1 = sqlsrv_connect('192.168.176.35\SQLEXPRESS');
//searching for the database 
if (isset($_POST['submit'])) {
    $pass = $_POST['password'];
    $user = strtoupper($_POST['email']);
    $user = stripslashes($user);
    $pass = stripslashes($pass);
    $temp = explode('@', $user);
    $sup = "SELECT name FROM master.dbo.sysdatabases where name!='master' and name!='msdb' and name!='model' and name='$temp[1]'";

    $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt = sqlsrv_query($conn1, $sup, $params, $options);
//$stmt = sqlsrv_query( $conn, $sql );
    if ($stmt === false) {
        if (($errors = sqlsrv_errors() ) != null) {
            foreach ($errors as $error) {
                echo "SQLSTATE: " . $error['SQLSTATE'] . "<br />";
                echo "code: " . $error['code'] . "<br />";
                echo "message: " . $error['message'] . "<br />";
                echo $sql;
            }
        }
    } else if (sqlsrv_num_rows($stmt) === 1) {
		setcookie('database', $temp[1], time() + (86400 * 30), "/");
		$_SESSION['database']=$temp[1];
//login part
require "config.php";
        $sql = "SELECT * FROM dbo.Sales_Rep WHERE S_Emails = '$user' and S_Password = '$pass' and [Employee_status]='1'";
        $params = array();
        $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
        $stmt1 = sqlsrv_query($conn, $sql, $params, $options);
//$stmt = sqlsrv_query( $conn, $sql );
        if ($stmt1 === false) {
            if (($errors = sqlsrv_errors() ) != null) {
                foreach ($errors as $error) {
                    echo "SQLSTATE: " . $error['SQLSTATE'] . "<br />";
                    echo "code: " . $error['code'] . "<br />";
                    echo "message: " . $error['message'] . "<br />";
                    echo $sql;
                }
            }
			
        } else if ( sqlsrv_num_rows($stmt1) === 1) {
         
            $row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC);
            $_SESSION['username'] = $row['S_Emails'];
			setcookie('username', $row['S_Emails'], time() + (86400 * 30), "/");
            $_SESSION['name'] = $row['SalesID'];
			setcookie('saleid', $row['SalesID'], time() + (86400 * 30), "/");
            $_SESSION['Role'] = $row['S_Role'];
			setcookie('role', $row['S_Role'], time() + (86400 * 30), "/");
            //echo $_SESSION['Role'];
            switch ($_SESSION['Role']) {
                case 'Manager';
                    header('Location:dashboard1.php');
                    break;
                case 'Consultant';
                    header('Location:dashboard.php');
                    break;
                case 'Team Leader';
                    header('Location:Team.php');
                    break;
                case 'Admin';
                    header('Location:Admin.php');
                    break;
            }


            //header('Location:sales.php');
            echo '';
            echo $row['SalesID'];
        } else {

            $_SESSION['message'] = '<div class="alert alert-error">Check Your Creditials</div>';
        }

        
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">

    <title>Login Screen</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style type="text/css">
    @import url("https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
.login-block{
    background: #DE6262;  /* fallback for old browsers */
background: -webkit-linear-gradient(to bottom,  #d3d376, #cccc00);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to bottom, #d3d376, #cccc00); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
float:left;
width:100%;
padding : 145px 0;
}
.banner-sec{background:url(https://static.pexels.com/photos/33972/pexels-photo.jpg)  no-repeat left bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}
.container{background:#fff; border-radius: 20px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
.carousel-inner{border-radius:0 10px 10px 0;}
.carousel-caption{text-align:left; left:5%;}
.login-sec{padding: 50px 30px; position:relative;}
.login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
.login-sec .copy-text i{color:#d3d376;}
.login-sec .copy-text a{color:#cccc00;}
.login-sec h2{margin-bottom:40px; font-weight:800; font-size:30px; color: #afaf03;}
.login-sec h2:after{content:" "; width:100px; height:5px; background:#d3d376; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
.btn-login{background: #cccc00; color:#fff; font-weight:600;}
.btn-login1{background: #ccc; color:#fff; font-weight:600;}
.banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
.banner-text h2{color:#fff; font-weight:600;}
.banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
.banner-text p{color:#fff;}
    </style>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>
<body>
	<section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center">Login Now</h2>
		    <form class="login-form" action =<?php echo $_SERVER['PHP_SELF']; ?> method="post">
  <div class="form-group">
        <label form="email" class="control-label col-sm-3">Email</label>
          <div class="col-sm-8">
              <input type="email" class="form-control" name="email" required placeholder="Enter email">
  </div>
     </div>
  <div class="form-group">
       <label for="pwd" class ="control-label col-sm-3">Password</label>
  <div class="col-sm-8">
       <input type="password" class="form-control" name="password" required placeholder="Enter password">
  </div>
     </div>
  
    <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" class="form-check-input">
      <small>Remember Me</small>
    </label>
    <input type="submit" value="submit" name="submit" class="btn btn-login"><br><br>
    <?php echo $_SESSION['message']; ?>
     <button type="tryforfree" formaction="reguser/Bootstrap.html" class="btn btn-login1">TRY FOR FREE</button>
    
    
  </div>
  
</form>
<div class="copy-text">Created with <i class="fa fa-heart"></i> by <a href="http://ikworx.co.za">ikworx.co.za</a></div>
		</div>
		<div class="col-md-8 banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                 <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                  </ol>
            <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block"> </div>
    
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>This is Heaven</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
            <form>
         <button type="submit" formaction="registerUser.php" class="btn btn-login">TRY FOR FREE</button>
         </form>   
        </div>	
    </div>
    </div>
    
        <div class="carousel-item">
      <img class="d-block img-fluid" src="../20160423_180456.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>This is Heaven</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
            <form>
         <button type="submit" formaction="registerUser.php" class="btn btn-login">TRY FOR FREE</button>
         </form>   
        </div>	
    </div>
    </div>
    
        <div class="carousel-item">
      <img class="d-block img-fluid" src="../20160131_110421_Richtone(HDR).jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>This is Heaven</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
            <form>
         <button type="submit" formaction="reguser/Bootstrap.html" class="btn btn-login">TRY FOR FREE</button>
         </form>   
        </div>	
    </div>
    </div>
    
    
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>This is Heaven</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
            <form>
            <button type="submit" formaction="reguser/Bootstrap.html" class="btn btn-login">TRY FOR FREE</button> 
            </form>
            <br>

        </div>	
    </div>
  </div>
            </div>	   
		    
		</div>
	</div>
</div>
</section>
	<script type="text/javascript">
	
	</script>
</body>
</html>
