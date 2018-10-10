
<?php

require "config.php";
          
    if(isset($_POST['submit']))
    {
                  
        $nameS = $_POST['fname'];
        $sql1="DELETE FROM dbo.Sales_Rep WHERE SalesID='$nameS'";
        $stmt1 = sqlsrv_query( $conn, $sql1 );
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
    }
                   
                   
            
$sql="SELECT * FROM dbo.Sales_Rep";
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
<!DOCTYPE html>
<html>
<title>Add sales</title>
<head>
<fieldset>
<body bgcolor="silver">

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<link href="table.css" rel="stylesheet" type="text/css">
<fieldset>
<legend><h5 align="center"><font  color="#cccc00" face="Segoe" size="+6">Delete Sales Member</font></h5></legend>
<div class="container"> 
   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       Clicked_SalesID:&nbsp; &nbsp;
       <input type="text" name="fname" id="fname" readonly><br><br>
       <br><br>
       SalesID:&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
    <input type="text" name="Sales_ID" value="Search with SalesID" 
           onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Sales_ID" onblur="TBlur(this.id);">
       <br><br>
        Search Name:&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;   
    <input type="text" name="Name_Text" value="Search with Name" 
            onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Name_Text" onblur="TBlur(this.id);">
        <br><br> 
        Search Surname:&nbsp;&nbsp; 
    <input type="text" name="Surname_Text" value="Search with Surname"
           onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Surname_Text" onblur="TBlur(this.id);">
        <br><br>   
        <input type="submit" name="submit" value="Delete">
        
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
/*function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("Sales_ID");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}*/
</script> 



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
         <a href="TeamLeaderHome.php">Back menu</a > 

</body>
</div>
</form>
</fieldset>
</head>
</html>