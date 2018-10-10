<?php
ob_start();
session_start();

$InvoiceStatus ='';
$CheckedRD = $_POST['gender'];
$selected = $_POST['CaseStatement'];
$NamesRecords = $_POST['AllCourses'];  
$name='';
$surname='';
$custID = '';

if($CheckedRD=="Pending")
{
   $InvoiceStatus = "Not yet paid"; 
}
 else {
    $InvoiceStatus = "payed"; 
}


function displayleads($Selectedcase, $SelectedCourse, $Status)
{
    require "config.php";
      
    /*$sql="select Name,Surname,Email,Phone,Company,Designation,I_Status,Prod_Name,Prod_Duration,Prod_Price
	  from dbo.Invoice i,dbo.Lead l, dbo.Product p, dbo.Customer c
        where i.Lead_ID=l.LeadID and p.Prod_ID=l.Prod_ID and DATENAME(m, l.Date_Created) = '$Selectedcase' and 
        l.CustID=c.CustID and p.Prod_ID LIKE '%$SelectedCourse%'";*/
   $saleid='S001';
    $sql="select distinct c.CustID,a.SalesID, c.Name,c.Surname,c.Email,c.Phone,c.Company,c.Designation,i.I_Status,p.Prod_Name,p.Prod_Duration,p.Prod_Price
          from dbo.Invoice i,dbo.Lead l, dbo.Product p, dbo.Customer c, dbo.AssignTask a, dbo.Sales_Rep s
          where i.Lead_ID=l.LeadID
          and i.I_Status = '$Status'
          and p.Prod_ID=l.Prod_ID 
          and c.CustID=a.custid
          and l.CustID =a.custid
          and DATENAME(m, l.Date_Created) = '$Selectedcase'           
          and p.Prod_ID LIKE '%$SelectedCourse%' 
          and a.SalesID ='$saleid'";
    $stmt = sqlsrv_query($conn,$sql);
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
</head>

<body bgcolor="silver">

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<link href="table.css" rel="stylesheet" type="text/css">

<h5 align="center"><font  color="Green" face="Segoe" size="+6"> View Leads Table </font></h5>
 

     
<form action="AssignedLeads.php" method="POST">    
    
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
    </div>
    
    </form>
               
        <form action="<?php echo "$_SERVER[PHP_SELF]"; ?>" method="POST">     
       
        <div style="overflow:auto; height:500px;width:100%">    
	      
	<table style="margin-left: 50px; margin-right: 50px;" class="data-table" align="center" id="table" border="1" style="cursor: pointer;">
		
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
                    
                    
                <?php
                    echo displayleads($selected,$NamesRecords,$InvoiceStatus);               
                 ?> 
		</tbody>
	</table>
     <div>    
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
            
        </form>
 
</body>

</head>
</html>