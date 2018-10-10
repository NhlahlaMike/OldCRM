<?php
session_start();
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
            
           
        </form>
   
    </body>
</html>
