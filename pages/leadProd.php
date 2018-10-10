<?php
ob_start();
session_start();
include 'session.php';

?>
<?php

//echo isset($_POST['fname']);
require "config.php";


if(isset($_POST['fname']))
$up=$_POST['fname'];
else
$up=$_SESSION['custID'];

$update="UPDATE [dbo].[Status]
   SET [Status_Name] = 'New Opportunity',
    [Status_Date]=getdate()
 WHERE custID='$up'";
 $stmt2 = sqlsrv_query( $conn, $update );
 if( $stmt2 === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql;
        }
    }
}


if(isset($_POST['fname']))
$custID=$_POST['fname'];
else
{
$custID=$_SESSION['custID'];
unset($_SESSION['custID']);
}


$sql1= "select * from dbo.Lead";
$stmt1 = sqlsrv_query( $conn, $sql1 );

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
$sql="SELECT * FROM dbo.product";
//$params = array();
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


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Product</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="To-copy/jquery.autofill.js"></script>
 <link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
</head>
<link href="table.css" rel="stylesheet" type="text/css">
<script src="jquery.redirect.js"></script>
<body>
	<h1>Product Table</h1>
    
   <form action="invoice.php" method="POST">
   CustID:<input type="text" name="custID" id="custID"  value="<?php echo $custID;?>" readonly><br><br>
   Prod ID:<input type="text" name="ProdType" id="prodid" ><br><br>
   Lead ID:<input type="text" name="leadID" id="leadID"  value="<?php echo $leadID?>" readonly><br><br>
   prod Price:<input type="text" name="prodPrice" id="prodPrice" size="60px" readonly ><br><br>
   Prod Name:<input type="text" name="ProdName" id="prodName" size="60px" readonly ><br><br>
   <br>
   
   <input type="submit"  name="sub">
   </form>
   
   <form action="soft_delete.php" method="post">
   <input type="hidden" name="lcopy" id="copy"  value="" readonly>
   <input type="submit" value="Disqualified" onClick="populateSecondTextBox();"></form>
   
	<table class="data-table" align="center" id="table" border="1" style="cursor: pointer;">
		<thead>
			<tr>
				<th>Product ID</th>
				<th>Prod Name</th>
				
                <th>Price</th>
				                               
			</tr>
		</thead>
		<tbody>
		<?php
		
		while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
		{
		
			echo '<tr>
					<td>'.$row['Prod_ID'].'</td>
					<td>'.$row['Prod_Name'].'</td>
					
					<td>'.$row['Prod_Price'].'</td>
					                                         
				</tr>';
			
		}?>
		</tbody>
	</table>
        
               <script>
    
                var table = document.getElementById('table');
                
                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                         //rIndex = this.rowIndex;
                         document.getElementById("prodid").value = this.cells[0].innerHTML;
                         document.getElementById("prodName").value = this.cells[1].innerHTML;
						 document.getElementById("prodPrice").value = this.cells[2].innerHTML;
						 
                         //document.getElementById("age").value = this.cells[2].innerHTML;
                    };
                }
    
         </script>

 
 <script>
function populateSecondTextBox() {
    document.getElementById('copy').value = document.getElementById('leadID').value;
}
</script>
</body>

</html>

?>
