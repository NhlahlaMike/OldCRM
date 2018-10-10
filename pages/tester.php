<?php
ob_start();
session_start();
//require_once("var/conf.Super.php");

if(isset($_POST['create'])){
	$email=strtoupper($_POST['email']);
	$password=$_POST['pass1'];
	$package=$_POST['package'];
	$company=$_POST['company'];
	$country=$_POST['country'];
	$temp=explode('@',$email);
        $serverName = "192.168.176.32\SQLEXPRESS";
        $UID = "ikworx";
        $PWD = "Xibelani@54";
        //$Database = "CRM_db";
        
        $connectionInfo = array("UID"=>$UID,"PWD"=>$PWD);
        $conn1 = sqlsrv_connect( $serverName, $connectionInfo);


//$domain='glory';
$sql='CREATE DATABASE ['.$temp[1].']';
$stmt = sqlsrv_query( $conn1, $sql );
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
$backup='USE ['.$temp[1].']
CREATE TABLE [dbo].[AssignTask](
                [tsID] [varchar](50) NOT NULL,
                [SalesID] [varchar](10) NULL,
                [stMonth] [datetime] NULL,
                [custid] [varchar](50) NULL,
CONSTRAINT [PK_AssignTask] PRIMARY KEY CLUSTERED 
(
                [tsID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
/****** Object:  Table [dbo].[Case]    Script Date: 3/19/2018 3:02:16 PM ******/
SET ANSI_NULLS ON
;
SET QUOTED_IDENTIFIER ON
;
SET ANSI_PADDING ON
;
CREATE TABLE [dbo].[Case](
                [CaseID] [varchar](10) NOT NULL,
                [SupportRequirement] [varchar](50) NULL,
                [ProductRating] [varchar](50) NULL,
                [RatingComment] [varchar](50) NULL,
                [PurchaseID] [varchar](10) NULL,
CONSTRAINT [PK_Case] PRIMARY KEY CLUSTERED 
(
                [CaseID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
/****** Object:  Table [dbo].[Company]    Script Date: 3/19/2018 3:02:16 PM ******/
SET ANSI_NULLS ON
;
SET QUOTED_IDENTIFIER ON
;
SET ANSI_PADDING ON
;
CREATE TABLE [dbo].[Company](
                [Company_ID] [varchar](10) NOT NULL,
                [Name] [varchar](50) NULL,
                [Contact_Person] [varchar](50) NULL,
                [Contact_email] [nchar](10) NULL,
                [Sector] [varchar](50) NULL,
                [Location] [varchar](50) NULL,
                [Country] [varchar](50) NULL,
                [CustID] [varchar](10) NULL
) ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
/****** Object:  Table [dbo].[Customer]    Script Date: 3/19/2018 3:02:16 PM ******/
SET ANSI_NULLS ON
;
SET QUOTED_IDENTIFIER ON
;
SET ANSI_PADDING ON
;
CREATE TABLE [dbo].[Customer](
                [CustID] [varchar](10) NOT NULL,
                [Name] [varchar](50) NOT NULL,
                [Surname] [varchar](50) NOT NULL,
                [Email] [varchar](50) NOT NULL,
                [Password] [varchar](50) NULL,
                [Phone] [varchar](50) NULL,
                [Company] [varchar](10) NULL,
                [Designation] [varchar](50) NULL,
                [Address] [varchar](50) NULL,
                [City] [varchar](50) NULL,
                [Zip_code] [varchar](50) NULL,
                [Province] [varchar](50) NULL,
                [Country] [varchar](50) NULL,
                [Date_Added] [datetime] NULL,
                [SalesID] [varchar](10) NOT NULL,
CONSTRAINT [PK_Customer] PRIMARY KEY CLUSTERED 
(
                [CustID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
/****** Object:  Table [dbo].[Delivery]    Script Date: 3/19/2018 3:02:16 PM ******/
SET ANSI_NULLS ON
;
SET QUOTED_IDENTIFIER ON
;
SET ANSI_PADDING ON
;
CREATE TABLE [dbo].[Delivery](
                [DeliveryID] [varchar](10) NOT NULL,
                [DeliveryMode] [varchar](50) NULL,
                [DeliveryVanue] [varchar](50) NULL,
                [DeliveryStartDate] [varchar](50) NULL,
                [DeliveryEndDate] [nchar](10) NULL,
                [PurchaseID] [varchar](10) NULL
) ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
/****** Object:  Table [dbo].[Invoice]    Script Date: 3/19/2018 3:02:16 PM ******/
SET ANSI_NULLS ON
;
SET QUOTED_IDENTIFIER ON
;
SET ANSI_PADDING ON
;
CREATE TABLE [dbo].[Invoice](
                [Invoice_ID] [varchar](10) NOT NULL,
                [I_Status] [varchar](20) NULL,
                [Invoice_cost] [numeric](18, 2) NULL,
                [Additional_Costs] [numeric](18, 2) NULL,
                [AC_Description] [varchar](max) NULL,
                [Lead_ID] [varchar](10) NULL,
CONSTRAINT [PK_Invoice] PRIMARY KEY CLUSTERED 
(
                [Invoice_ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
/****** Object:  Table [dbo].[Lead]    Script Date: 3/19/2018 3:02:16 PM ******/
SET ANSI_NULLS ON
;
SET QUOTED_IDENTIFIER ON
;
SET ANSI_PADDING ON
;
CREATE TABLE [dbo].[Lead](
                [LeadID] [varchar](10) NOT NULL,
                [CustID] [varchar](10) NULL,
                [Description] [varchar](50) NULL,
                [Product] [varchar](50) NULL,
                [Date_Created] [varchar](50) NULL,
                [Prod_ID] [varchar](10) NULL,
CONSTRAINT [PK_Lead] PRIMARY KEY CLUSTERED 
(
                [LeadID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
/****** Object:  Table [dbo].[notify]    Script Date: 3/19/2018 3:02:16 PM ******/
SET ANSI_NULLS ON
;
SET QUOTED_IDENTIFIER ON
;
SET ANSI_PADDING ON
;
CREATE TABLE [dbo].[notify](
                [Title] [varchar](50) NULL,
                [Comment] [varchar](50) NULL,
                [status] [smallint] NULL,
                [InvoiceID] [varchar](50) NULL,
                [SalesID] [varchar](10) NOT NULL,
                [ID] [int] NOT NULL,
CONSTRAINT [PK_notify] PRIMARY KEY CLUSTERED 
(
                [ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
/****** Object:  Table [dbo].[Payment]    Script Date: 3/19/2018 3:02:16 PM ******/
SET ANSI_NULLS ON
;
SET QUOTED_IDENTIFIER ON
;
SET ANSI_PADDING ON
;
CREATE TABLE [dbo].[Payment](
                [Payment_ID] [varchar](100) NOT NULL,
                [Payment_Method] [varchar](50) NULL,
                [Payment_Date] [datetime] NULL,
                [Payer] [varchar](50) NULL,
                [Invoice_ID] [varchar](10) NULL,
                [Payment_Status] [tinyint] NULL,
                [Hash] [varchar](100) NULL,
CONSTRAINT [PK_Payment] PRIMARY KEY CLUSTERED 
(
                [Payment_ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
/****** Object:  Table [dbo].[Product]    Script Date: 3/19/2018 3:02:16 PM ******/
SET ANSI_NULLS ON
;
SET QUOTED_IDENTIFIER ON
;
SET ANSI_PADDING ON
;
CREATE TABLE [dbo].[Product](
                [Prod_ID] [varchar](10) NOT NULL,
                [Prod_Name] [varchar](100) NULL,
                [Prod_Duration] [varchar](50) NULL,
                [Prod_Price] [numeric](18, 2) NULL,
CONSTRAINT [PK_Product] PRIMARY KEY CLUSTERED 
(
                [Prod_ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
/****** Object:  Table [dbo].[Purchase_Item]    Script Date: 3/19/2018 3:02:16 PM ******/
SET ANSI_NULLS ON
;
SET QUOTED_IDENTIFIER ON
;
SET ANSI_PADDING ON
;
CREATE TABLE [dbo].[Purchase_Item](
                [PurchaseID] [varchar](10) NOT NULL,
                [Purchase_name] [varbinary](50) NULL,
                [Purchase_Price] [numeric](18, 2) NULL,
                [Purchase_Desc] [varchar](50) NULL,
                [Purchase_Date] [datetime] NULL,
                [Purchase_Method] [varchar](50) NULL,
                [InvoiceID] [varchar](10) NULL
) ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
/****** Object:  Table [dbo].[Sales_Rep]    Script Date: 3/19/2018 3:02:16 PM ******/
SET ANSI_NULLS ON
;
SET QUOTED_IDENTIFIER ON
;
SET ANSI_PADDING ON
;
CREATE TABLE [dbo].[Sales_Rep](
                [SalesID] [varchar](10) NOT NULL,
                [S_Name] [varchar](30) NULL,
                [S_Surname] [varchar](30) NULL,
                [S_Role] [varchar](30) NULL,
                [S_Emails] [varchar](30) NULL,
                [S_Password] [varchar](30) NULL
) ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
/****** Object:  Table [dbo].[Status]    Script Date: 3/19/2018 3:02:16 PM ******/
SET ANSI_NULLS ON
;
SET QUOTED_IDENTIFIER ON
;
SET ANSI_PADDING ON
;
CREATE TABLE [dbo].[Status](
                [StatusID] [varchar](10) NOT NULL,
                [CustID] [varchar](10) NULL,
                [Status_Name] [varchar](max) NULL,
                [Status_Date] [datetime] NULL,
CONSTRAINT [PK_Status] PRIMARY KEY CLUSTERED 
(
                [StatusID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
/****** Object:  Table [dbo].[Users]    Script Date: 3/19/2018 3:02:16 PM ******/
SET ANSI_NULLS ON
;
SET QUOTED_IDENTIFIER ON
;
SET ANSI_PADDING ON
;
CREATE TABLE [dbo].[Users](
                [User_ID] [varchar](10) NOT NULL,
                [User_Name] [varchar](50) NULL,
                [User_Surname] [varchar](50) NULL,
                [User_email] [varchar](30) NULL,
                [User_Password] [varchar](30) NULL,
                [User_role] [varchar](30) NULL,
CONSTRAINT [PK_Users] PRIMARY KEY CLUSTERED 
(
                [User_ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
USE [master]
;
ALTER DATABASE ['.$temp[1].'] SET  READ_WRITE 
;
';

$stmt1 = sqlsrv_query( $conn1, $backup );
if( $stmt1 === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $backup;
        }
    }
}
$insert="INSERT INTO [dbo].[SuperUser]
           ([AdminEmail]
           ,[AdminPassword]
           ,[PackageType]
           ,[DatabaseName]
           ,[CompanyName]
           ,[Country]
           ,[DateCreated])
     VALUES
           ('$email'
           ,'$password'
           ,'$package'
           ,'$temp[1]'
           ,'$company'
           ,'$country'
           ,getdate())";
		   	
$stmt2 = sqlsrv_query( $super, $insert );
if( $stmt2 === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $insert;
        }
    }
}
$_SESSION['database']=$temp[1];
require ("config.php");		
//inserting to the sales database
		 $sales="INSERT INTO [dbo].[Sales_Rep]
           ([SalesID]

           ,[S_Name]
           ,[S_Surname]
           ,[S_Role]
           ,[S_Emails]
           ,[S_Password])
     VALUES
           ('S001'
           ,'Admin'
           ,'Admin'
           ,'Manager'
           ,'$email'
           ,'$password')";
		   $stmt3 = sqlsrv_query( $conn, $sales );
if( $stmt3 === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sales;
        }
    }
}
//sqlsrv_close( $conn1 );
//sqlsrv_close( $super );
//sqlsrv_close( $conn );
header('Location:login.php');
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>user registration</title>
 <link href="stylesheet.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet.css" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js">
        </script>
</head>
<!DOCTYPE html><html lang='en' class=''>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="tes.css" rel="stylesheet" type="text/css ">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<head><script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script><meta charset='UTF-8'><meta name="robots" content="noindex"><link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" /><link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" /><link rel="canonical" href="https://codepen.io/mrtuanphong/pen/NqvePZ?depth=everything&order=popularity&page=56&q=product&show_forks=false" />

<link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css'><link rel='stylesheet prefetch' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
<style class="cp-pen-styles">
</style></head><body>
<div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-2">
               <a class="btn big-login" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Try for free</a>  
                 </div>
            <div class="col-sm-3"></div>
        </div>
		 <div class="modal fade login" id="loginModal">
    		      <div class="modal-content">
    		         <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Try for free</h4>
                    </div>
                    <div class="modal-body">  
                        <div class="box">
                             <div class="content">
                                <div class="social">
                                    <a class="circle twitter" href="/auth/twitter">
                                        <i class="fa fa-twitter fa-fw"></i>
                                    </a>
                                    <a id="google_login" class="circle google" href="/auth/google_oauth2">
                                        <i class="fa fa-google-plus fa-fw"></i>
                                    </a>
                                    <a id="facebook_login" class="circle facebook" href="/auth/facebook">
                                        <i class="fa fa-facebook fa-fw"></i>
                                    </a>
                                     <a id="linkedin_login" class="circle linkedin" href="/auth/linkedin">
                                        <i class="fa fa-linkedin fa-fw"></i>
                                    </a>
                                </div>
                                <div class="division">
                                    <div class="line l"></div>
                                </div>
                                <div class="error"></div>
                                <div class="form loginBox">
 <form method="post" action="/login" accept-charset="UTF-8">
 eMail: 
<input type="text" name="email">
<br><br>
 Password: 
<input type="password" name="pass1"  id="txtPassword" onkeyup="CheckPasswordStrength(this.value)">
<span id="password_strength"></span>
<br><br>

<label for="country">Country*</label><br><br>
<select name="country" size="1"> 
 <option value="Afghanistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="United Kingdom">United Kingdom</option>
<option value="American Samoa">American samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua">Antigua</option>
<option value="South Africa">South Africa</option>
<option value="Armenia">Armenia</option><option value="Aruba">Aruba</option>
<option value="Australia">Austtralia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="The Bahamas">The bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Uganda">Uganda</option>
<option value="Zimbabwe">Zimbabwe</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Taiwan">Taiwan</option>
<optiohn value="Bhutan">Bhutan</select>

<form>
</select>

<br><br>
<label for="package">Package Type</label>
<select name="package" size="1"> 
<option value="0">Free Trial</option> 
<option value="1">Premium</option>
</select>
<br><br>
<br><br>
<input  align="middle"type="submit" name="create" id="start_button" value="Create Account" disabled>


                                    </form>
                                </div>
                             </div>
                        </div>
                        
                    
    		     
<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script><script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
<script >$(document).ready(function(){
  openLoginModal();   
});


/*
 *
 * login-register modal
 * Autor: Creative Tim
 * Web-autor: creative.tim
 * Web script: http://creative-tim.com
 * 
 */
function showRegisterForm(){
    $('.loginBox').fadeOut('fast',function(){
        $('.registerBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast',function(){
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Register with');
    }); 
    $('.error').removeClass('alert alert-danger').html('');
       
}
function showLoginForm(){
    $('#loginModal .registerBox').fadeOut('fast',function(){
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast',function(){
            $('.login-footer').fadeIn('fast');    
        });
        
        $('.modal-title').html('Login with');
    });       
     $('.error').removeClass('alert alert-danger').html(''); 
}

function openLoginModal(){
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}
function openRegisterModal(){
    showRegisterForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}

function loginAjax(){
    /*   Remove this comments when moving to server
    $.post( "/login", function( data ) {
            if(data == 1){
                window.location.replace("/home");            
            } else {
                 shakeModal(); 
            }
        });
    */

/*   Simulate error message from the server   */
     shakeModal();
}

function shakeModal(){
    $('#loginModal .modal-dialog').addClass('shake');
             $('.error').addClass('alert alert-danger').html("Invalid email/password combination");
             $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
}

   
//# sourceURL=pen.js
</script>


</html>