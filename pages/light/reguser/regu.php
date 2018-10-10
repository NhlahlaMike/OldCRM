<?php ob_start();
session_start();
require_once("../var/conf.Super.php");


	$email=strtoupper($_POST['email']);
	$password=$_POST['pass1'];
	//$package=$_POST['package'];
	$company=$_POST['company'];
	$country=$_POST['country'];
	$phone=$_POST['phone'];
	$name=$_POST['name'];
	$surname=$_POST['surname'];
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
/****** Object:  Table [dbo].[Case]    Script Date: 3/27/2018 10:41:29 AM ******/
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
/****** Object:  Table [dbo].[Company]    Script Date: 3/27/2018 10:41:29 AM ******/
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
/****** Object:  Table [dbo].[Customer]    Script Date: 3/27/2018 10:41:29 AM ******/
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
/****** Object:  Table [dbo].[Delivery]    Script Date: 3/27/2018 10:41:29 AM ******/
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
/****** Object:  Table [dbo].[Invoice]    Script Date: 3/27/2018 10:41:29 AM ******/
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
/****** Object:  Table [dbo].[Lead]    Script Date: 3/27/2018 10:41:29 AM ******/
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
/****** Object:  Table [dbo].[notify]    Script Date: 3/27/2018 10:41:29 AM ******/
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
	[Date_Added] [datetime] NULL,
 CONSTRAINT [PK_notify] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
/****** Object:  Table [dbo].[Payment]    Script Date: 3/27/2018 10:41:29 AM ******/
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
/****** Object:  Table [dbo].[Product]    Script Date: 3/27/2018 10:41:29 AM ******/
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
/****** Object:  Table [dbo].[Purchase_Item]    Script Date: 3/27/2018 10:41:29 AM ******/
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
/****** Object:  Table [dbo].[Sales_Rep]    Script Date: 3/27/2018 10:41:29 AM ******/
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
	[S_Password] [varchar](30) NULL,
	[Employee_status] [varchar](max) NULL,
	[Address] [varchar](50) NULL,
	[City] [varchar](50) NULL,
	[Postal_code] [varchar](50) NULL,
	[Profile_Picture] [varchar](50) NULL,
	[Country] [varchar](50) NULL,
 CONSTRAINT [PK_Sales_Rep] PRIMARY KEY CLUSTERED 
(
	[SalesID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

;
SET ANSI_PADDING OFF
;
/****** Object:  Table [dbo].[Status]    Script Date: 3/27/2018 10:41:29 AM ******/
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
/****** Object:  Table [dbo].[Users]    Script Date: 3/27/2018 10:41:29 AM ******/
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
           ,'free'
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
setcookie('database', $temp[1], time() + (86400 * 30), "/");
require ("../configCookie.php");		
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
           ,'$name'
           ,'$surname'
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
echo $message='<center><div style="width:300px" id="success" class="alert alert-success"><a href="../login.php" >Account  created successfully (Click here To Login)</a></div>';


?>