  <?php
ob_start();
session_start();
// error_reporting(0);
require "Config.php";
	
$sql= "select S_Name, SalesID from dbo.Sales_Rep";
$stmt = sqlsrv_query($conn, $sql);
if(isset($_POST['submit'])){
	$_SESSION['lead_status'] = $_POST['lead_status'];
	$_SESSION['Sales_name'] = $_POST['Sales_name']; 
	$_SESSION['month'] = $_POST['month'];
}
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
 <!DOCTYPE html>
 <html lang="en">
 <head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <style type="text/css">
	#regiration_form fieldset:not(:first-of-type) {
		display: none;
	}
  </style>
  <link href="../table.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
  <title>View leads per sale's Person</title>
</head>
<body>
  <div class="container">
    <h1></h1>
	<div class="progress">
		<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
	</div>
	
	<form id="regiration_form" novalidate action=""  method="post">
	<fieldset>
		<font size="20"><strong><h1>View Leads Per Sale's Person</h1></font></strong>
        <hr><br>
        <font size="3">
        
        <div style="margin-left: 4%">
        Select Sales Rep: <select name="Sales_name" style="width: 130px;" required>
<option value="" disabled selected>Select a name</option>

<?php
// error_reporting(0);
//selects sales rep names from the database

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
	
	echo'<option value="'.$row['SalesID'].'">'.$row['S_Name'].'</option>';
	}
	//end of select

?>

</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

Select Status of lead: <select name="lead_status" style="width: 140px;" required>
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

Select the month: <select name="month" style="width: 130px;" required>
<option value="" disabled selected>Select duration</option>
<option value="Weekly" selected>Weekly</option>

<?php
 //error_reporting(0);
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
AND i.I_Status = '$Status'
AND a.SalesID = '$Sales_name'
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
</font>
</div>
<br> 
<br> 

<div style="margin-left: 45%">
  <font size="3"> <input type="submit" name="submit" value="View leads"></font>
   </div>
    
<br>

    
   <?php
   // error_reporting(0);
   //this is correct
   //Getting the data from the db according to the selected s_name and status
	   
	   //11
	   if(isset($_POST['submit'])){
   $sql2 = "select distinct(s.S_Name), s.salesid, c.custid, c.name, c.surname, c.phone, c.email, l.product, i.I_Status, datename(mm,l.Date_Created) as Date
from Sales_Rep s, Customer c, Lead l, Invoice i, Product p, AssignTask a
where a.SalesID = s.SalesID
AND c.CustID = l.CustID
AND l.Prod_ID = p.Prod_ID
AND l.LeadID = i.Lead_ID
AND datename(mm, a.stMonth) = datename(mm, l.Date_Created)
AND i.I_Status = '".$_SESSION['lead_status']."'
AND a.SalesID = '".$_SESSION['Sales_name']."'
AND datename(MM, a.stMonth) = '".$_SESSION['month']."'";
   $stmt2 = sqlsrv_query($conn, $sql2);
   
   echo "<font size='3'><strong>You have selected sonsultant: ".$_SESSION['Sales_name']."</strong></font>";

	   }
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
 //error_reporting(0);
//11
if(isset($_POST['submit'])){

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
		}
}
		?>
		
        </tbody>
	</table>
    </div>
    <br>
    <td width='80' class='center'>
    <?php
	
echo "<font color=#E92326 size='4'><strong><center> NB: YOU CAN NOT VIEW THE GRAPH OR EXPORT DATA BEFORE YOU TABLE VIEW A SALES REPRESENTATIVE</center></font></strong>"

?>
<?php
// error_reporting(0);
//this is correct
//getting the target
	
	//11
	if(isset($_POST['submit'])){
$sql_get_target = "select count(a.custid) as stTarget from assigntask a where a.SalesID = '".$_SESSION['Sales_name']."'";

$stmt3 = sqlsrv_query($conn, $sql_get_target);

	while( $row = sqlsrv_fetch_array( $stmt3,  SQLSRV_FETCH_BOTH) ) 
		{
					 $_SESSION['targetno']=$row['stTarget'];
		}

//edit edit!!!!!!!!!!!!
//getting number of leads according to status
$sql_get_leads = "select s.S_Name, s.salesid, c.custid, c.name, c.surname, c.phone, c.email, l.product, i.I_Status, datename(mm, L.Date_Created)
from Sales_Rep s, Customer c, Lead l, Invoice i, Product p, AssignTask a
where a.SalesID = s.SalesID
AND c.CustID = l.CustID
AND l.Prod_ID = p.Prod_ID
AND l.LeadID = i.Lead_ID
AND datename(mm, a.stMonth) = datename(mm, l.Date_Created)
AND i.I_Status = '".$_SESSION['lead_status']."'
AND a.SalesID = '".$_SESSION['Sales_name']."'
AND datename(mm, a.stMonth) = '".$_SESSION['month']."'
Group by s.S_Name, s.salesid, c.custid, c.name, c.surname, c.phone, c.email, l.product, i.I_Status, l.Date_Created";

 $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt6 = sqlsrv_query($conn, $sql_get_leads, $params, $options);
	 $num_leads =sqlsrv_num_rows($stmt6);
	 
	 $_SESSION['num_leads'] = $num_leads;
	 
	}

?>

</td>
<!--NEXT BUTTON-->
<input type="button" name="data[password]" class="next btn btn-info" value="Next" style="height: 40px; width: 80px;"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<input type="submit" name="data[password]" class="next btn btn-info" value="Export data" style="height: 40px; width: 90px;"/>
</fieldset>
	<fieldset>
		<font size="20"><strong><h1>Pie Chart</h1></font></strong>
        <hr>
<?php
/*$sql= "Select datename(MM,date_created) as date_created from dbo.Leads";

$stmt = sqlsrv_query($conn, $sql);

if(isset($_POST['submit'])){
   
    	
		while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
		{
			
			$Date_created=$row['date_created'];
			$leadscount = "select datename(MM, date_created) as date_created, count([Prod_ID]) as number_leads FROM [CRM_db].[dbo].[Lead] Oder by date_created";
		
		echo $leadscount;	
			
		}
}*/

?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	  
      function drawChart() {  
        var data1 = google.visualization.arrayToDataTable([
         ['Months', 'Number of Leads per month'],
         ['Target', <?php echo $_SESSION['targetno'] ?>],
         ['Leads', <?php echo $_SESSION['num_leads'] ?>]

        ]);

        var options1 = {
			title: '',
			 'width':1500, 'height':700,
		is3D: true,
           };


        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data1, options1);
		
      }
    </script>
    <div id="piechart" style="width: 1500px; height: 700px;"></div>
    
    <style type="text/css">
    .btn {
        background-color: #0FBEC7;
        cursor:pointer;
    }
</style>
    
    <!--PREVIOUS BUTTON-->
		<input type="button" name="previous" class="previous btn btn-default" value="Previous" style="height: 40px; width: 80px;"/>
	
    </fieldset>
	</form>
  </div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	var current = 1,current_step,next_step,steps;
	steps = $("fieldset").length;
	$(".next").click(function(){
		current_step = $(this).parent();
		next_step = $(this).parent().next();
		next_step.show();
		current_step.hide();
		setProgressBar(++current);
	});
	$(".previous").click(function(){
		current_step = $(this).parent();
		next_step = $(this).parent().prev();
		next_step.show();
		current_step.hide();
		setProgressBar(--current);
	});
	setProgressBar(current);
	// Change progress bar action
	function setProgressBar(curStep){
		var percent = parseFloat(100 / steps) * curStep;
		percent = percent.toFixed();
		$(".progress-bar")
			.css("width",percent+"%")
			.html(percent+"%");		
	}
});
</script>