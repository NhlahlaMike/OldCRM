<?php
ob_start();
session_start();
 error_reporting(0);
    $selected = $_POST['CaseStatement'];
    $NamesRecords = $_POST['AllCourses'];
$name='';
$surname='';
$custID = '';


function displayleads($Selectedcase, $SelectedCourse)
{
    

    if($Selectedcase=="1")  {  
    require "light/config.php";
      
    $sql="select Name,Surname,Email,Phone,Company,Designation,I_Status,Prod_Name,Prod_Duration,Prod_Price
	  from dbo.Invoice i,dbo.Lead l, dbo.Product p, dbo.Customer c
        where i.Lead_ID=l.LeadID and p.Prod_ID=l.Prod_ID and 
        l.CustID=c.CustID and I_Status='Not Yet paid' and p.Prod_ID LIKE '%$SelectedCourse%'";
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
        
		while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
		{
		
			echo '<tr>
					<td>'.$row['Name'].'</td>
					<td>'.$row['Surname'].'</td>
					<td>'.$row['Email'].'</td>
					<td>'.$row['Phone'].'</td>
					<td>'.$row['Company'].'</td>
					<td>'.$row['Designation'].'</td>
					<td>'.$row['I_Status'].'</td>
					<td>'.$row['Prod_Name'].'</td>
					<td>'.$row['Prod_Duration'].'</td>
					<td>'.$row['Prod_Price'].'</td>
                                           
				</tr>';
			
		}
        
    }
    if($Selectedcase=="2")
    {
    require "config.php";
      
    $sql="select Name,Surname,Email,Phone,Company,Designation,I_Status,Prod_Name,Prod_Duration,Prod_Price
	  from Invoice i,Lead l, Product p, Customer c
        where i.Lead_ID=l.LeadID and p.Prod_ID=l.Prod_ID and 
        l.CustID=c.CustID and I_Status='Payed' and p.Prod_ID LIKE '%$SelectedCourse%'";
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
		while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
		{
		
			echo '<tr>
					<td>'.$row['Name'].'</td>
					<td>'.$row['Surname'].'</td>
					<td>'.$row['Email'].'</td>
					<td>'.$row['Phone'].'</td>
					<td>'.$row['Company'].'</td>
					<td>'.$row['Designation'].'</td>
					<td>'.$row['I_Status'].'</td>
					<td>'.$row['Prod_Name'].'</td>
					<td>'.$row['Prod_Duration'].'</td>
					<td>'.$row['Prod_Price'].'</td>                                          
                                           
				</tr>';
			
		}
        
    }
    
}

if(isset($_POST['lblname']) && isset($_POST['lblsurname']) && isset($_POST['txtEmail']) &&
isset($_POST['txtPhone']) && isset($_POST['txtCompany']) && isset($_POST['txtDesignation']) &&
isset($_POST['txtI_Status']) && isset($_POST['txtProd_Name']) && isset($_POST['txtProd_Duration']) &&
isset($_POST['txtProd_Price'])) 
{
$name = $_POST['lblname']; $surname = $_POST['lblsurname']; $CustEmail = $_POST['txtEmail'];
$Phonenumber = $_POST['txtPhone']; $CustCompany = $_POST['txtCompany']; $Desg = $_POST['txtDesignation'];
$InvStatus = $_POST['txtI_Status']; $Prodname = $_POST['txtProd_Name']; $Proddsc = $_POST['txtProd_Duration'];
$Prodprice = $_POST['txtProd_Price'];    
}

?>

<!DOCTYPE html>
<html>
<title>Add sales</title>
<head>
<style>
.labelSelect 
{
  background: lightblue; 
  border: 2px solid black;
  padding-left: 10px; 
  padding-right: 10px;      
}    
</style>
<fieldset>
<body bgcolor="silver">

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<link href="table.css" rel="stylesheet" type="text/css">
<fieldset>
<legend><h5 align="center"><font  color="Green" face="Segoe" size="+6"> Case Member Management </font></h5></legend>
      
     
<form action="CaseProgress.php" method="POST">
          
        <label style="visibility:hidden"><b>Clicked_SalesID:&nbsp; &nbsp;</b></label>
        <input type="text" name="fname" id="fname" style="visibility:hidden"  readonly><br>
    <div align="center" class="one-third">  
    <br>        
    <label><font size="4">Search by:&nbsp;</font></label>   
       SalesID: 
    <input type="text" name="Sales_ID" value="Search with SalesID"  
           onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Sales_ID" onblur="TBlur(this.id);">
       &nbsp; 
        Search Name:
    <input type="text" name="Name_Text" value="Search with Name" 
            onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Name_Text" onblur="TBlur(this.id);">
        &nbsp; 
        Search Surname: 
    <input type="text" name="Surname_Text" value="Search with Surname"
           onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Surname_Text" onblur="TBlur(this.id);">
        <br><br>  
       <input type="submit" name="submit" class="btn btn-success" onclick="return handleChange()" value="View Case Info">
        <label >Click the member to view: </label>
        <label class="labelSelect" name="lblviewname" id="lblviewname"><font size="4"></label>
        <input name="lblname" id="lblname" style="visibility:hidden">
        <input name="lblsurname" id="lblsurname" style="visibility:hidden">
        <input name="txtEmail" id="txtEmail" style="visibility:hidden">
        <input name="txtPhone" id="txtPhone" style="visibility:hidden">
        <input name="txtCompany" id="txtCompany" style="visibility:hidden">
        <input name="txtDesignation" id="txtDesignation" style="visibility:hidden">
        <input name="txtI_Status" id="txtI_Status" style="visibility:hidden">
        <input name="txtProd_Name" id="txtProd_Name" style="visibility:hidden">        
        <input name="txtProd_Duration" id="txtProd_Duration" style="visibility:hidden">
        <input name="txtProd_Price" id="txtProd_Price" style="visibility:hidden">
    </div>
    </form>
               
        <form action="<?php echo "$_SERVER[PHP_SELF]"; ?>" method="POST">     
    
        <div style="overflow:auto; height:500px;width:100%">          
	<table style="margin-left: 50px; margin-right: 50px;"  class="data-table" align="center" id="table" border="1" style="cursor: pointer;">
		
		<thead>
				<th>Name</th>
				<th>Surname</th>
                                <th>Email</th>
				<th>Phone</th>
				<th>Company</th>
                                <th>Designation</th>
				<th>I_Status</th>
				<th>Prod_Name</th>
                                <th>Prod_Duration</th>
				<th>Prod_Price</th>                            
			</tr>
		</thead>
		<tbody>    
              <a href="light/CaseReport.php">Back</a>      
                    
                <?php
				 error_reporting(0);
                    echo displayleads($selected,$NamesRecords);               
                 ?> 
		</tbody>
	</table>
 <div>
               <script>
    
                var table = document.getElementById('table');
                
                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                         //rIndex = this.rowIndex;
                         document.getElementById("fname").value = this.cells[0].innerHTML;
                         document.getElementById("lblviewname").innerHTML = this.cells[0].innerHTML +"  "+this.cells[1].innerHTML;
                         document.getElementById("lblname").value = this.cells[0].innerHTML;
                         document.getElementById("lblsurname").value = this.cells[1].innerHTML;
                         document.getElementById("txtEmail").value = this.cells[2].innerHTML;
                         document.getElementById("txtPhone").value = this.cells[3].innerHTML;                         
                         document.getElementById("txtCompany").value = this.cells[4].innerHTML;
                         document.getElementById("txtDesignation").value = this.cells[5].innerHTML;
                         document.getElementById("txtI_Status").value = this.cells[6].innerHTML;
                         document.getElementById("txtProd_Name").value = this.cells[7].innerHTML;
                         document.getElementById("txtProd_Duration").value = this.cells[8].innerHTML;
                         document.getElementById("txtProd_Price").value = this.cells[9].innerHTML;

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
      <script>
    function handleChange(input) {
        var x = document.getElementById("fname").value;
        if (x === "") {
            alert("Please Click the table to select the case");
            return false;
        }
        return true;
        document.getElementById("fname").value="";
    }  
      </script>                    
            
        </form>
  
</body>
</fieldset>
</head>
</html>