<?php
ob_start();
session_start();

require "light/Config.php";

$sql= "select S_Name, SalesID from dbo.Sales_Rep";
$stmt = sqlsrv_query($conn, $sql);

	$Status = $_POST['lead_status'];
	$Sales_name = $_POST['Sales_name'];
	$month = $_POST['month'];
	
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error['code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql;
        }
    }
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View leads per Sales Rep </title>

<style type='text/css'>
.center {
    text-align:center;
}
</style>

</head>

<link href="table.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>

<center><h1>View leads per Sales Rep</h1></center>
<hr>

<body>

    <br>
   <form action="ManagerViewLeadsPerSales.php" method="post">
<div style="margin-left: 4%">
Select Sales Rep: <select name="Sales_name" style="width: 200px;" >
<option value="" disabled selected>Select a name</option>

<?php
//selects sales rep names from the database

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
	
	echo'<option value="'.$row['SalesID'].'">'.$row['S_Name'].'</option>';
	}
	//end of select
?>

</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

Select Status of lead: <select name="lead_status" style="width: 200px;" >
<option value="" disabled selected>Select lead type</option>

<?php
//select the status 

$sql1= "select distinct(I_Status) from dbo.Invoice";
$stmt1 = sqlsrv_query($conn, $sql1);

while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ){
	echo'<option value="'.$row['I_Status'].'">'.$row['I_Status'].'</option>';
	}
?>
</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

Select the month: <select name="month" style="width: 200px;" >
<option value="" disabled selected>Select a month</option>
<option value="Weekly" selected>Weekly</option>

<?php
//select the month, date not in order

/*$sql_get_month = "select distinct(datename(mm, a.stMonth)) as month from dbo.assigntask a, Sales_Rep s where s.SalesID = a.SalesID group by a.stMonth order by datename(mm, a.stMonth)";
$stmt5 = sqlsrv_query($conn, $sql_get_month);

while( $row = sqlsrv_fetch_array( $stmt5, SQLSRV_FETCH_ASSOC) ){
			echo'<option value="'.$row['month'].'">'.$row['month'].'</option>';
	}
	*/
	
	//date in order
	
if($month == "Weekly"){
	
	$sql_get_month = "select distinct dateadd(DAY, -7, GETDATE()) as Date
from Sales_Rep s, Customer c, Lead l, Invoice i, Product p, AssignTask a
where s.SalesID = c.SalesID
AND a.SalesID = s.SalesID
AND c.CustID = l.CustID
AND l.Prod_ID = p.Prod_ID
AND l.LeadID = i.Lead_ID
AND datename(mm, a.stMonth) = datename(mm, l.Date_Created)
AND i.I_Status = 'Not yet paid'
AND a.SalesID = 'S005'
AND datename(mm, a.stMonth) = datename(mm, GETDATE())
OR l.Date_Created between dateadd(DAY, -7, GETDATE()) and GETDATE()";
	
	}else{
			$sql_get_month = "select distinct month(a.stMonth),datename(mm,a.stMonth) as date2
from AssignTask a
order by month(a.stMonth),datename(mm,a.stMonth)";
		}
	
$stmt5 = sqlsrv_query($conn, $sql_get_month);

while( $row = sqlsrv_fetch_array( $stmt5, SQLSRV_FETCH_ASSOC) ){
			
			echo'<option value="'.$row['date2'].'">'.$row['date2'].'</option>';
	}

?>

</select>

</div>
<br> 
<div style="margin-left: 45%">
   <input type="submit" name="submit" value="View leads">
   </div>
   </form> 
<br>    
   
   <?php
   
   //this is correct
   //Getting the data from the db according to the selected s_name and status
   $sql2 = "select distinct(s.S_Name), s.salesid, c.custid, c.name, c.surname, c.phone, c.email, l.product, i.I_Status, datename(mm,l.Date_Created) as Date
from Sales_Rep s, Customer c, Lead l, Invoice i, Product p, AssignTask a
where s.SalesID = c.SalesID
AND a.SalesID = s.SalesID
AND c.CustID = l.CustID
AND l.Prod_ID = p.Prod_ID
AND l.LeadID = i.Lead_ID
AND datename(mm, a.stMonth) = datename(mm, l.Date_Created)
AND i.I_Status = '$Status'
AND a.SalesID = '$Sales_name'
AND datename(MM, a.stMonth) = '$month'";
   $stmt2 = sqlsrv_query($conn, $sql2);
   
   echo 'you have selected sonsultant: '.$Sales_name;
   ?>
   
      <div style="overflow-x:auto;">
      <br>
	<table  align="center" class="data-table" id="table"  border="1" style="cursor: pointer;">
		
		<thead>
			<tr>
				<th>Sale_ID</th>
				<th>Customer_ID</th>
				<th>Customer_Name</th>
                <th>Customer_Surname</th>
				<th>Cusstomer_Phone</th>
				<th>Customer_Email</th>
                <th>Course</th>
                <th>Status</th>
                <th>Date</th>
                                   
			</tr>
		</thead>
        <tbody>
		
        
		<?php
		
		while( $row = sqlsrv_fetch_array( $stmt2,  SQLSRV_FETCH_BOTH) ) 
		{
		
			echo '<tr">
					<td>'.$row['salesid'].'</td>
					<td>'.$row['custid'].'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['surname'].'</td>
					<td>'.$row['phone'].'</td>
					<td>'.$row['email'].'</td>
					<td>'.$row['product'].'</td>
					<td>'.$row['I_Status'].'</td> 
					<td>'.$row['Date'].'</td>                                           
				</tr>';
				
			
		}?>
		
        </tbody>
	</table>
    </div>
    <br>
    <td width='80' class='center'>
    <?php
	
echo "<font color=#E92326><center> NB: YOU CAN NOT VIEW GRAPH BEFORE YOU TABLE VIEW A SALES REPRESENTATIVE</center></font>"

?>

<?php
//this is correct
//getting the target
$sql_get_target = "select count(a.custid) as stTarget from assigntask a where a.SalesID = '$Sales_name'";

$stmt3 = sqlsrv_query($conn, $sql_get_target);

	while( $row = sqlsrv_fetch_array( $stmt3,  SQLSRV_FETCH_BOTH) ) 
		{
					 $_SESSION['targetno']=$row['stTarget'];
		}

//edit edit!!!!!!!!!!!!
//getting number of leads according to status
$sql_get_leads = "select s.S_Name, s.salesid, c.custid, c.name, c.surname, c.phone, c.email, l.product, i.I_Status, datename(mm, L.Date_Created)
from Sales_Rep s, Customer c, Lead l, Invoice i, Product p, AssignTask a
where s.SalesID = c.SalesID
AND a.SalesID = s.SalesID
AND c.CustID = l.CustID
AND l.Prod_ID = p.Prod_ID
AND l.LeadID = i.Lead_ID
AND datename(mm, a.stMonth) = datename(mm, l.Date_Created)
AND i.I_Status = '$Status'
AND a.SalesID = '$Sales_name'
AND datename(mm, a.stMonth) = '$month'
Group by s.S_Name, s.salesid, c.custid, c.name, c.surname, c.phone, c.email, l.product, i.I_Status, l.Date_Created";

 $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt6 = sqlsrv_query($conn, $sql_get_leads, $params, $options);
	 $num_leads =sqlsrv_num_rows($stmt6);
	 
	 $_SESSION['num_leads'] = $num_leads;
	 
?>

</td>

<div style="margin-left: 45%">
<form action="PieChartPract.php" method="POST">

<input type="submit" name="view_chart" value="View graph">
</form>   
</div> 

</body>
</html>