<?php
ob_start();
session_start();
require "config.php";
//include 'session.php';

?>
<?php
$message='';
$me='selected';
if(isset($_POST['sub']))
{
	$custID=$_POST['var2'];
	$status=$_POST['status'];
	$nam=$_POST['var3'];
	$update="UPDATE [dbo].[Status]
   SET [Status_Name] = '$status',
    [Status_Date]=getdate()
 WHERE custID='$custID'";
 $stmt2 = sqlsrv_query( $conn, $update );
 if( $stmt2 === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $update;
        }
    }
}
$message='<center><div style="width:300px" id="success" class="alert alert-success">'.$nam.'</div>';
}

if(isset($_POST['myselect']))
{$stat=$_POST['myselect'];
$me='';}
else
$stat='Not Attempted';

$sale=$_SESSION['name'];

$sql="select  * from Customer c,AssignTask a, Status where c.CustID=a.custid and Status.CustID=c.CustID and a.SalesID='$sale' and Status.Status_Name='$stat'";
$params = array();
////$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
//$stmt = sqlsrv_query( $conn, $sql , $params, $options );
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




$sql1= "select * from dbo.Lead";
$stmt1 = sqlsrv_query( $conn, $sql1 );
 $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt1 = sqlsrv_query($conn, $sql1, $params, $options);
	if (sqlsrv_num_rows($stmt1) >= 1)
{
	while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) 
		{
			
			$temp= explode("L",$row['LeadID']);
			
			
			
		}
		$temp[1]+=1;
		$num = 123;
$str_length = 3;

// hardcoded left padding if number < $str_length
$leadID= substr("0000{$temp[1]}", -$str_length);

// output: 0123
		
		//$custID="L".$temp[1];
		 $leadID="L".$leadID;
		 }
		 else
		 $leadID="L001";
		 
$sqlLead="SELECT * FROM dbo.product";
//$params = array();
////$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
//$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$stmtLead = sqlsrv_query( $conn, $sql );
if( $stmt === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sqlLead;
        }
    }
}
	$sqlINVO= "select * from dbo.Invoice";
 $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmtINVO = sqlsrv_query($conn, $sqlINVO, $params, $options);
	if (sqlsrv_num_rows($stmtINVO) >= 1)
{

	while( $row = sqlsrv_fetch_array( $stmtINVO, SQLSRV_FETCH_ASSOC) ) 
		{
			
			$temp= explode("INV",$row['Invoice_ID']);

			
			
			
		}
		$temp[1]+=1;
		$num = 123;
$str_length = 3;

// hardcoded left padding if number < $str_length
$inv= substr("0000{$temp[1]}", -$str_length);

// output: 0123
		
		//$custID="L".$temp[1];
		  $inv="INV".$inv;
		  }
		  else 
		  $inv="INV";
		  
		  $sql6="SELECT * FROM dbo.product";
//$params = array();
////$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
//$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$stmt6 = sqlsrv_query( $conn, $sql6 );
if( $stmt6 === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql6;
        }
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Customer</title>
</head>
<link href="../table.css" rel="stylesheet" type="text/css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
  <style type="text/css">
  
	#regiration_form fieldset:not(:first-of-type) {
		display: none;
	}
	
	</style>

<body>
 <div class="container">
<h1>Customer</h1>
<div class="progress">
    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div id="flex-container" class="well well-sm">
  <div   class="flex-item">
  <form action="Editcustomer.php" method="post" >
  	<input type="text"  name="var" id="copy1">
    <br>
    <br>
    <input type ="submit" name ="na" id="su" class="btn btn-info" value="Edit" disabled>
    </form>
    </div>
    
    
     <div class="form-group flex-item" >
  <form action="" id="form1" method="post" >
  	<input type="hidden"  name="var2" id="copy2">
    <input type="text" class="form-control"  name="var3" id="fullnames">
    <select name="status" style="width:auto"  class="form-control" id="sel12">
        <option value="Not Attempted">Not Attempted</option>
        <option value="New Opportunity">New Opportunity</option>
        <option  value="Disqualified">Disqualified</option>
        <option  value="Contacted">Contacted</option>
        <option  value="Attempted">Attempted</option>
        <option  value="Additional Contact">Additional Contact</option>
    </select>
    <input type ="submit" name ="sub" id="sub" class="btn btn-info form-control" disabled value="Change Status">
    <div><?php echo $message?></div>
    </form>
    </div>
    
    
         <div class="form-group flex-item" >
  <form action="view.php" id="select" method="post" >
  <label for="sel1">Filter by Status</label>
  	   <select style="width:auto"  class="form-control" id="sel1" name="myselect" id="myselect" onChange="this.form.submit()">
            <option <?php echo $me; ?> value="" >Filter By Status</option>
        <option <?php if ($stat == 'Not Attempted' ) echo 'selected' ; ?> value="Not Attempted">Not Attempted</option>
        <option <?php if ($stat == 'New Opportunity' ) echo 'selected' ; ?> value="New Opportunity">New Opportunity</option>
        <option <?php if ($stat == 'Disqualified' ) echo 'selected' ; ?> value="Disqualified">Disqualified</option>
        <option <?php if ($stat == 'Contacted' ) echo 'selected' ; ?> value="Contacted">Contacted</option>
        <option <?php if ($stat == 'Attempted' ) echo 'selected' ; ?> value="Attempted">Attempted</option>
        <option <?php if ($stat == 'Additional Contact' ) echo 'selected' ; ?>value="Additional Contact">Additional Contact</option>
    </select>
   
    </form>
    </div>
    </div>
   <form action="send.php" novalidate method="post" id="regiration_form">
  <fieldset>
   <input type="button" name="data[password]" class="next btn btn-info" value="Next" />
	
    <div style="margin-left: 8%" class="form-group flex-item">
    <input type="text" id="myInput" style="width:auto" class="form-control flex-item"  size="27px" onkeyup="myFunction()" placeholder="Search by email" title="Type in a name">
 
  
  
   CustID:<input type="text" style="width:auto" name="fname" id="fname" required class="readonly form-control flex-item" >
   
 
   <script>
    $(".readonly").keydown(function(e){
        e.preventDefault();
    });
</script>
   <div style="margin-left: 6%">
   
   </div>
   
   
 

  
   
   
   </div>
   <br>
   <div style="overflow:auto; height:500px;width:100%">
	<table  align="center" class="data-table table" id="table"  border="1" style="cursor: pointer;">
		
		<thead>
			<tr>
				<th>CustID</th>
				<th>Name</th>
				<th>Last Name</th>
                <th>email</th>
				<th>phone</th>
				<th>comapny</th>
                <th>Designation</th>
                <th>Status</th>
                <th>SalesID</th>                                
			</tr>
		</thead>
        <tbody>
		
        
		<?php
		
		while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
		{
		
			echo '<tr">
					<td>'.$row['CustID'].'</td>
					<td>'.$row['Name'].'</td>
					<td>'.$row['Surname'].'</td>
					<td>'.$row['Email'].'</td>
					<td>'.$row['Phone'].'</td>
					<td>'.$row['Company'].'</td>
					<td>'.$row['Designation'].'</td>
					<td>'.$row['Status_Name'].'</td>
					<td>'.$row['SalesID'].'</td>                                            
				</tr>';
			
		}?>
		
        </tbody>
	</table>
    </div>
    </fieldset>
    
    <fieldset>
    
    		<input type="button" name="previous" class="previous btn btn-default" value="Previous" />
		
    	<h1>Product Table</h1>
    
  
   Invoice No: <strong><input type="text" name="invoice" value="<?php echo $inv; ?>" style="border: none" readonly></strong><br><br>
   Prod ID:<input type="text" name="ProdType" id="prodid"  style="border: none" > <br><br>
   Lead ID:<input type="text" name="leadID" id="leadID" style="border: none"  value="<?php echo $leadID?>" readonly><br><br>
   prod Price:<input type="text" name="prodPrice" id="prodPrice" style="border: none"  size="60px" readonly ><br><br>
   Prod Name:<input type="text" name="ProdName" id="prodName" style="border: none"  size="60px" readonly ><br><br>
   <br>
   

  
   <input type="submit" id="start_button" name="submit" class="submit btn btn-success" value="Submit" id="submit_data" disabled />
   
	<table class="data-table" align="center" id="table1" border="1" style="cursor: pointer;">
		<thead>
			<tr>
				<th>Product ID</th>
				<th>Prod Name</th>
				
                <th>Price</th>
				                               
			</tr>
		</thead>
		<tbody>
         
		<?php
		
		while( $row1 = sqlsrv_fetch_array( $stmt6,  SQLSRV_FETCH_BOTH) ) 
		{
		
			echo '<tr>
					<td>'.$row1['Prod_ID'].'</td>
					<td>'.$row1['Prod_Name'].'</td>
					
					<td>'.$row1['Prod_Price'].'</td>
					                                         
				</tr>';
			
		}?>
		</tbody>
	</table>


    </fieldset>
    
    
        </form>
                       <script>
    
                var table = document.getElementById('table1');
                
                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                         //rIndex = this.rowIndex;
                         document.getElementById("prodid").value = this.cells[0].innerHTML;
                         document.getElementById("prodName").value = this.cells[1].innerHTML;
						 document.getElementById("prodPrice").value = this.cells[2].innerHTML;
						    if(validate() == true) { 
            document.getElementById('start_button').disabled = false; 
        } else { 
            document.getElementById('start_button').disabled = true;
        }
                         //document.getElementById("age").value = this.cells[2].innerHTML;
                    };
                }
    
         </script>
<script>
                var table = document.getElementById('table');
                
                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                         //rIndex = this.rowIndex;
                         document.getElementById("fname").value = this.cells[0].innerHTML;
                        // document.getElementById("lname").value = this.cells[1].innerHTML;
                         //document.getElementById("age").value = this.cells[2].innerHTML;
						 document.getElementById("fullnames").value =this.cells[1].innerHTML+" "+this.cells[2].innerHTML;;
						 if(enable() == true)
						 {
							 document.getElementById('sub').disabled = false;
							 document.getElementById('su').disabled = false;
						 }
						 
						 
						 
						 
						    if(validate() == true) { 
            document.getElementById('start_button').disabled = false; 
        } else { 
            document.getElementById('start_button').disabled = true;
        }
                    };
                }

    
         </script>
<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}


</script>
<script>
$(document).ready(function()
{
    $('#table').click(function()
    {
         $('#copy1').val($('#fname').val());
    });
});
</script>
<script>
$(document).ready(function()
{
    $('#table').click(function()
    {
         $('#copy2').val($('#fname').val());
    });
});
</script>


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
<script type="text/javascript">
    function validate(){
		
		if(document.getElementById("fname").value.length <= 0)
		return false;
		else if(document.getElementById("prodName").value.length <= 0)
		return false;
		else if(document.getElementById("prodPrice").value.length <= 0)
		return false;
		else if(document.getElementById("prodid").value.length <= 0)
		return false;
		else 
		return true;
	}
	function enable()
	{
		if(document.getElementById("fullnames").value.length > 0)
		return true;
		else false;
	}
	
	
		

    
   // function verify(){
       // if (myTextempty){
          //  alert "Put some text in there!"
        //  //  return;
      //  }
       // else{
	//		
      //      do button functionality
      //  }
    
</script>
<script>
$(document).ready(function (e) {
	$("#success").fadeOut(3000);
	
})
</script>
