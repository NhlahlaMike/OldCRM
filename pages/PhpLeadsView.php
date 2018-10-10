<?php
ob_start();
session_start();
$selected ='';
$NamesRecords='';


require "light/config.php";
$sql="SELECT * FROM dbo.Product";
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
   require "light/config.php";
    $sql="SELECT * FROM dbo.AssignTask";
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

   $todayMonth = date("F");  
   
    if($todayMonth=="January"){ $reports = array('January'); }
    if($todayMonth=="February"){ $reports = array('January','February'); }
    if($todayMonth=="March"){ $reports = array('January','February','March'); }    
    if($todayMonth=="April"){ $reports = array('January','February','March','April'); }    
    if($todayMonth=="May"){ $reports = array('January','February','March','April', 'May'); } 
    if($todayMonth=="June"){ array('January','February','March','April', 'May','June'); }   
    if($todayMonth=="July"){  $reports = array('January','February','March','April', 'May','June', 
            'July'); }
    if($todayMonth=="August"){ $reports = array('January','February','March','April', 'May','June', 
            'July', 'August'); }            
    if($todayMonth=="September"){ $reports = array('January','February','March','April', 'May','June', 
            'July', 'August', 'September'); }
    if($todayMonth=="October"){ $reports = array('January','February','March','April', 'May','June', 
            'July', 'August', 'September', 'October'); }            
    if($todayMonth=="November"){ $reports = array('January','February','March','April', 'May','June', 
            'July', 'August', 'September', 'October', 'November'); }            
    if($todayMonth=="December"){ $reports = array('January','February','March','April', 'May','June', 
            'July', 'August', 'September', 'October', 'November', 'December'); }
            
    $options = '';
    
    while(list($k,$v)= each($reports))
    {
        if($select==$v)
        {
            $options .='<option value="'.$v.'"selected>'.$v.'</option>';
        }
        else 
        {
            $options .='<option value="'.$v.'">'.$v.'</option>';
        }
        
    }
    
    return $options;
           
}


function loadSalesNames()
   {  
            
    require "light/config.php";
    $message='';
    $sql= "Select prod_id, Prod_Name from dbo.Product";
    $stmt = sqlsrv_query( $conn, $sql );      
       $SalesMember = '';
       while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
           {  
               $SalesMember = $row["Prod_Name"];
               $prodid=$row['prod_id'];
               echo "<option value='".$prodid."'>".$SalesMember."</option>"; 				
           }
           $memberNames = $SalesMember;
           return $memberNames;           
    } 


if(isset($_POST['CaseStatement']) && isset($_POST['AllCourses']))
{
    $selected = $_POST['CaseStatement'];
    $NamesRecords = $_POST['AllCourses'];
    echo $selected;
    echo $NamesRecords;

} 


?>

<?PHP

$male_status = 'unchecked';
$female_status = 'unchecked';

if (isset($_POST['Submit1'])) {

$selected_radio = $_POST['gender'];

if ($selected_radio == 'Pending') {

$male_status = 'checked';

}
else if ($selected_radio == 'Not Pending') {

$female_status = 'checked';

}

}


if(isset($_POST['gender']))
{

$selected_radio = $_POST['gender'];
} 
?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
<fieldset>
<body bgcolor="silver">

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<link href="table.css" rel="stylesheet" type="text/css">
<fieldset>
<legend><h5 align="center"><font  color="navy" face="Segoe" size="+6">Select leads to view</font></h5></legend>
        
        <form name ="seloption" action="AssignedLeads.php"  method="POST">
			
         <div align="center" class="one-third">   
             <br><br><br>
	 <div style="margin-left: 300px" class="row">		 
      <div class="col-sm-2">      
            Select Month:
        <div style="margin-top: 5px">
        <div style="position: relative;">
            <select name="CaseStatement" value="Select"
                    onmousedown="if(this.options.length>5){this.size=5;}"  
                    onchange='this.size=0;' onblur="this.size=0;">
            <?php echo get_options($selected); ?>
            </select>
        </div>
        </div> 
		 </div>  
			 
		<div class="col-sm-4">   
          	Select Course:
        <div style=" margin-left: 120px; margin-top: 5px">
        <div style="position: relative;">            
            <select name="AllCourses"
                    onmousedown="if(this.options.length>5){this.size=5;}"  
                    onchange='this.size=0;' onblur="this.size=0;">                    
            <?php        
              loadSalesNames();
            ?>  
            </select>
        </div>
        </div> 
	</div>   
            
<div class="col-sm-6"> 			     
<label style="margin-left: 20px;">Select status:</label>
 <br>            
<Input type = 'Radio' Name ='gender' value= 'Pending' 
<?PHP echo $male_status; ?>
       checked="1">Pending
<br>
&nbsp; &nbsp; &nbsp; 
<Input type = 'Radio' Name ='gender' value= 'Not Pending' 
<?PHP echo $female_status; ?>
>Not Pending
</div>	
<br><br><br>
</div>           
<button style="margin-left: 20px;" type="submit" name="submit1" class="btn btn-primary btn-lg" style="width:20%">View Case</button>
        </div>    
        </form>
</fieldset>   
    </body>
</html>
