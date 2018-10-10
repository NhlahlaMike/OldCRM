
<?php
error_reporting(0);
require "MessageArlet.php";
require "Config.php";

$male_status = '';
$female_status = '';
$EmployeeStatus='';
$message='';
$messageR = '';
$nameS = $_POST['fname'];

$state='';
$statedelete='';
if(isset($_POST['submitTable']))  
{    
$selected_radio = $_POST['EmpStatus'];

if ($selected_radio == 'Released') {

$male_status = 'checked';
$EmployeeStatus = "Not Employee";
$statedelete='disabled';

}
else if ($selected_radio == 'Employed') {

$female_status = 'checked';
$EmployeeStatus = "Employee";
$state='disabled';
 }
 
if($EmployeeStatus==='Employee') {           
$sql="SELECT * FROM dbo.Sales_Rep where Employee_status != '0'";
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
}else if($EmployeeStatus==='Not Employee'){
    $sql="SELECT * FROM dbo.Sales_Rep where Employee_status = '0'";
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
} 
 
}

    if(isset($_POST['Delete']))
    {
                  
       /* $sql1="DELETE FROM dbo.Sales_Rep WHERE SalesID='$nameS'";*/
        $selected_radio = $_POST['EmpStatus'];

if ($selected_radio == 'Released') {

$male_status = 'checked';
$EmployeeStatus = "Not Employee";
$statedelete='disabled';

}
else if ($selected_radio == 'Employed') {

$female_status = 'checked';
$EmployeeStatus = "Employee";
$state='disabled';
 }
        
$sql1="UPDATE dbo.Sales_Rep 
SET Employee_status = '0'
WHERE SalesID = '$nameS'";
$stmt1 = sqlsrv_query( $conn, $sql1 );

$sql="SELECT * FROM dbo.Sales_Rep where Employee_status != '0'";
$stmt = sqlsrv_query( $conn, $sql );

        if( $stmt1 === false ) 
        {
            if( ($errors = sqlsrv_errors() ) != null) 
            {
                foreach( $errors as $error ) 
                {
                echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                echo "code: ".$error[ 'code']."<br />";
                echo "message: ".$error[ 'message']."<br />";
                echo $sql1;
                }
            }
        }
        $message = '<div id="success" class="alert alert-success">Deleted Successfully</div>';    
 }

                    
if(isset($_POST['Reinstate']))
{
    $selected_radio = $_POST['EmpStatus'];

if ($selected_radio == 'Released') {

$male_status = 'checked';
$EmployeeStatus = "Not Employee";
$statedelete='disabled';

}
else if ($selected_radio == 'Employed') {

$female_status = 'checked';
$EmployeeStatus = "Employee";
$state='disabled';
 }
   $sqlb="UPDATE dbo.Sales_Rep 
SET Employee_status = '1'
WHERE SalesID = '$nameS'"; 
$stmt1 = sqlsrv_query( $conn, $sqlb );

$sql="SELECT * FROM dbo.Sales_Rep where Employee_status = '0'";
$stmt = sqlsrv_query( $conn, $sql );
        
        if( $stmt1 === false ) 
        {
            if( ($errors = sqlsrv_errors() ) != null) 
            {
                foreach( $errors as $error ) 
                {
                echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                echo "code: ".$error[ 'code']."<br />";
                echo "message: ".$error[ 'message']."<br />";
                echo $sqlb;
                }
            }
        }
       $messageR = '<div id="success" class="alert alert-success">Restored Successfully</div>';
}
    
?>
<!DOCTYPE html>
<html>
<title>Add sales</title>
<head>
<link href="MessageArletCss.css" rel="stylesheet" type="text/css">    
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<link href="table.css" rel="stylesheet" type="text/css">  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<style>
h3 {
	font-family: Cambria, Georgia, serif;
	font-size: 24px;
	font-style: normal;
	font-variant: normal;
	font-weight: 500;
	line-height: 15.4px;
        color:#1b4f9b;
}  

input[type="radio"]{
	display:inline;
	position:relative;    
        margin: 2 2px 2 2px;
}
</style>    
</head>
<fieldset>
<body bgcolor="silver">
 <?php echo $message; ?>
<?php echo $messageR; ?>
<fieldset>
<legend><h5 align="center"><font  color="#FF0004" face="Segoe" size="+6">Delete Sales Member</font></h5></legend>
<div class="container">   
   
   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       
    <br> <br><br> <br><br> <br>
   <h3> Please select employee status view: </h3>   
    
    <Input style="font-size: 14px;" type = 'Radio' Name ='EmpStatus' id="Employed" value= 'Employed' 
    <?PHP echo $female_status; ?>
    >Employed    
    <br>  
    <Input style="font-size: 14px;" type = 'Radio' Name ='EmpStatus' id ="Released" value= 'Released' 
    <?PHP echo $male_status; ?>
    >Released
    <p style="margin-bottom: 10px;"></p> 
    <input   type="submit" name="submitTable" id="submitTable" value="View by Status" onclick="execute()">      
     <br> <br> <br>
       SalesID:&nbsp; &nbsp;
    <input type="text" name="Sales_ID" value="Search with SalesID" 
           onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Sales_ID" onblur="TBlur(this.id);">  
        Search Name:&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;   
    <input type="text" name="Name_Text" value="Search with Name" 
            onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Name_Text" onblur="TBlur(this.id);">
         
        Search Surname:&nbsp;&nbsp; 
    <input type="text" name="Surname_Text" value="Search with Surname"
           onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Surname_Text" onblur="TBlur(this.id);">
     <br><br>   
    Clicked_SalesID:&nbsp; &nbsp;
       <input type="text" name="fname" id="fname" readonly>
       <br><br>
        <input <?php echo $statedelete ?> type="submit" name="Delete" id="Delete" value="Delete" onclick="return handleChange();">
        <input <?php echo $state ?> type="submit" name="Reinstate" id="Reinstate" value="Reinstate" onclick="return handleChange();">
       <br> <br>   
    
    </form>
    

    
	<table class="data-table" align="center" id="table" border="1" style="cursor: pointer;">
		
		<thead>
				<th>Sales_ID</th>
				<th>Name</th>
                                <th>Surname</th>
				<th>Position</th>
				<th>Email</th>
                                <th>Password</th>
                               
			</tr>
		</thead>
                
		<tbody>
                                       
		<?php
                error_reporting(0);
                		
		while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
		{
		
			echo '<tr>
					<td>'.$row['SalesID'].'</td>
					<td>'.$row['S_Name'].'</td>
					<td>'.$row['S_Surname'].'</td>
					<td>'.$row['S_Role'].'</td>
					<td>'.$row['S_Emails'].'</td>
					<td>'.$row['S_Password'].'</td>
                                           
				</tr>';
			
		}
                 
                ?>
		</tbody>
	</table>
        
               <script>
    
                var table = document.getElementById('table');
                
                for(var i = 1; i < table.rows.length; i++)
                        // document.getElementById("lname").value = this.cells[1].innerHTML;
                {
                    table.rows[i].onclick = function()
                    {
                         //rIndex = this.rowIndex;
                         document.getElementById("fname").value = this.cells[0].innerHTML;
                        // document.getElementById("lname").value = this.cells[1].innerHTML;
                         //document.getElementById("age").value = this.cells[2].innerHTML;
                    };
                }
    
         </script>
         
           <script>
         
            function TClear(str)
            {    
                document.getElementById(str).value= "";

                if(str == "Sales_ID")
                    {    
                        document.getElementById('Name_Text').value= "Search with Name";
                        document.getElementById('Surname_Text').value= "Search with Surname";
                    }
                if(str == "Name_Text")
                    {    
                        document.getElementById('Surname_Text').value= "Search with Surname";
                        document.getElementById('Sales_ID').value= "Search with Email"; 
                    }
                if(str == "Surname_Text")
                    {   
                        document.getElementById('Name_Text').value= "Search with Name"; 
                        document.getElementById('Sales_ID').value= "Search with Email";
                    }                                    
               
            }
                        
         </Script>
         
           <script>
 
            function myFunction(str)
            {    
                var input, filter, table, tr, td, i;
                input = document.getElementById(str);
                filter = input.value.toUpperCase();
                table = document.getElementById("table");
                tr = table.getElementsByTagName("tr");

                if(str == "Sales_ID")
                    { 
                    var indx = 0;
                    for (i = 0; i < tr.length; i++) 
                        {
                            td = tr[i].getElementsByTagName("td")[indx];
                
                            if (td) 
                            {
                                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) 
                                {
                                    tr[i].style.display = "";
                                } 
                                else 
                                {
                                    tr[i].style.display = "none";
                                }
                            }       
                        }
                    }
                if(str == "Name_Text")
                    {    
                    var indx = 1;
                    for (i = 0; i < tr.length; i++) 
                        {
                            td = tr[i].getElementsByTagName("td")[indx];
                
                            if (td) 
                            {
                                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) 
                                {
                                    tr[i].style.display = "";
                                } 
                                else 
                                {
                                    tr[i].style.display = "none";
                                }
                            }       
                        }
                    }
                if(str == "Surname_Text")
                    {   
                    var indx = 2;
                    for (i = 0; i < tr.length; i++) 
                        {
                            td = tr[i].getElementsByTagName("td")[indx];
                
                            if (td) 
                            {
                                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) 
                                {
                                    tr[i].style.display = "";
                                } 
                                else 
                                {
                                    tr[i].style.display = "none";
                                }
                            }       
                        }
                    }                                    
               
            }
                        
         </Script> 
         <br>
         <font color="red"><center><?php echo "NB: YOU CANNOT VIEW THE TABLE BEFORE YOU SELECT DELETE/REINSTATE A PERSON!!"; ?></center></font>

</form>

      <script>
    function handleChange() {
        var x = document.getElementById("fname").value;
        if (x === "") {
            alert("Please click the view by status button and select a person on the table.");
            return false;
        }
        return true;
        document.getElementById("fname").value="";
    }  
      </script>
      
      <script type="text/javascript">
        setTimeout(function(){
        if ($('#success').length > 0) 
        {
        $('#success').fadeOut("slow");
        /*$('#success').fadeOut(500); */
        }
        }, 1000)
     </script>

</body>
</div>
</fieldset>
</html>