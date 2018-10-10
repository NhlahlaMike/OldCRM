<?php
ob_start();
session_start();
//include 'session.php';

?>
<?php

require "config.php";
$sql="SELECT * FROM dbo.customer c, dbo.status s where Status_Name ='Not Attempted' and c.custid=s.custid";
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
<title>Customer</title>
</head>
<link href="table.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>

<body>
	<h1>Customer</h1>
    <div style="margin-left: 8%">
    <input type="text" id="myInput"  size="27" onkeyup="myFunction()" placeholder="Search by email" title="Type in a name">
    <br>
    <br>
   <form action="leadProd.php" method="post">
   CustID:<input type="text" name="fname" id="fname" readonly><br><br>
   <div style="margin-left: 6%">
   <input type="submit" name="submit">
   </div>
   </form>

  
   
   
   </div>
   <br>
   <div style="overflow-x:auto;">
	<table  align="center" class="data-table" id="table"  border="1" style="cursor: pointer;">
		
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

 
</body>
</html>