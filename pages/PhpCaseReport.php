<?php
$selected ='';
$NamesRecords='';


require "config.php";
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
    
    
    $reports = array('Open Case'=>1,'Resolved Case'=>2);
    
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

function loadSalesNames()
   {  
            
    require "config.php";
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
<legend><h5 align="center"><font  color="navy" face="Segoe" size="+6">Customer Case Management </font></h5></legend>
        
        <form name ="seloption" action="CaseProgressBar.php"  method="POST">
         <div align="center" class="one-third">   
             <br><br><br>
            
            Select Case:&nbsp;&nbsp;&nbsp;
            <select name="CaseStatement" value="Select">
            <?php echo get_options($selected); ?>
            </select>
            <br><br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;
            Select Course:
            <select name="AllCourses">
            <?php        
              loadSalesNames();
            ?>  
            </select>
            <br><br><br>
           
            <button type="submit" class="btn btn-primary btn-lg" style="width:20%">View Case</button><br>
             <a href="SaleManagerHome.php">Back</a> 
        </div> 
          
        </form>
</fieldset>   
    </body>
</html>