<?php
session_start();
    if((!isset($_SESSION['reports']) && !isset($_SESSION['status']) && !isset($_SESSION['AllSalesnames'])))
    {
        header("Location:index.php");  
    }
  /*  require "config.php";
$sql="SELECT * FROM dbo.Customer";
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
}*/
    $reports = $_SESSION['reports'];
    $status = $_SESSION['status'];
    $Salesnames =  $_SESSION['AllSalesnames'];
            
   
   function Daily($Selectduration,$selectStatus,$SalesConsultant)
   {
       if($Selectduration==1 && $selectStatus==1 )
            {
                echo "Daily<br>";
                echo "  ";
                echo "Not Attempted<br>";
                echo "Displaying Leads Report for, $SalesConsultant <br>";
                    
                require "config.php";
                $sql="SELECT * FROM dbo.Customer WHERE Name='$SalesConsultant'";
                $stmt = sqlsrv_query( $conn, $sql );
                
                while( $row = sqlsrv_fetch_array( $stmt,  SQLSRV_FETCH_BOTH) ) 
		{  
			echo '<tr>
					<td>'.$row['CustID'].'</td>
					<td>'.$row['Name'].'</td>
					<td>'.$row['Surname'].'</td>
					<td>'.$row['Email'].'</td>
					<td>'.$row['Phone'].'</td>
					<td>'.$row['Company'].'</td>
					<td>'.$row['Designation'].'</td>
					<td>'.$row['Address'].'</td>
					<td>'.$row['City'].'</td>
					<td>'.$row['Zip_code'].'</td>
					<td>'.$row['Province'].'</td>
					<td>'.$row['Country'].'</td>
                                        <td>'.$row['Date_Added']->format("d/m/y").'</td>
					<td>'.$row['SalesID'].'</td>                                            
				</tr>';
			
		}
$year = "2018";
$Strdate = "$year-02-01";
$date = date($Strdate);
                
$sql2 = "select count(*) from dbo.Customer where Date_Added between '$date' and '2018-12-31'";
$stmt2 = sqlsrv_query( $conn, $sql2 ); 
$rows = sqlsrv_fetch($stmt2);
echo $rows;
            }
       else if($Selectduration==1 && $selectStatus==2 )
            {
                echo "Daily";
                echo "  ";
                echo "Attempted";
            }
      else if($Selectduration==1 && $selectStatus==3)
            {
                echo "Daily";
                echo "  ";
                echo "Contacted";
            }
       else if ($Selectduration==1 && $selectStatus==4) 
            {
                echo "Daily";
                echo "  ";
                echo "Disqualified";                
            }
        else if ($Selectduration==1 && $selectStatus==5) 
            {
                echo "Daily";
                echo "  ";
                echo "New Opportunity";                
            }      
   }
   function Weekly($Selectduration,$selectStatus,$SalesConsultant)
   {
       if($Selectduration==2 && $selectStatus==1)
            {
                echo "Weekly";
                echo "  ";
                echo "Not Attempted";
            }
       else if($Selectduration==2 && $selectStatus==2)
            {
                echo "Weekly";
                echo "  ";
                echo "Attempted";
            }
      else if($Selectduration==2 && $selectStatus==3)
            {
                echo "Weekly";
                echo "  ";
                echo "Contacted";
            }
       else if ($Selectduration==2 && $selectStatus==4) 
            {
                echo "Weekly";
                echo "  ";
                echo "Disqualified";                
            }
        else if ($Selectduration==2 && $selectStatus==5) 
            {
                echo "Weekly";
                echo "  ";
                echo "New Opportunity";                
            }      
   }
   
   function Monthly($Selectduration,$selectStatus,$SalesConsultant)
   {
       if($Selectduration==3 && $selectStatus==1)
            {
                echo "Monthly";
                echo "  ";
                echo "Not Attempted";
            }
       else if($Selectduration==3 && $selectStatus==2)
            {
                echo "Monthly";
                echo "  ";
                echo "Attempted";
            }
      else if($Selectduration==3 && $selectStatus==3)
            {
                echo "Monthly";
                echo "  ";
                echo "Contacted";
            }
       else if ($Selectduration==3 && $selectStatus==4) 
            {
                echo "Monthly";
                echo "  ";
                echo "Disqualified";                
            }
        else if ($Selectduration==3 && $selectStatus==5) 
            {
                echo "Monthly";
                echo "  ";
                echo "New Opportunity";                
            }      
   }
   session_destroy();
   unset($_SESSION['reports']);
   unset($_SESSION['status']);
   unset($_SESSION['AllSalesnames']);
  
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body> 
        
        	<table>
		<caption >Customers</caption>
		<thead>
			<tr>
				<th>CustID</th>
				<th>Name</th>
                                <th>Surname</th>
				<th>email</th>
				<th>Phone</th>
                                <th>Company</th>
                                <th>Designation</th>
				<th>Address</th>
				<th>City</th>
				<th>Zip_code</th>
                                <th>Province</th>
				<th>Country</th>
                                <th>Date_Added</th>
                                <th>SalesID</th>                                
			</tr>
		</thead>
		<tbody>
		<?php
		        Daily($reports,$status,$Salesnames); 
                ?>
		</tbody>

	</table>
        
        <?php 
        Weekly($reports,$status,$Salesnames);
        Monthly($reports,$status,$Salesnames);
        ?>     
    </body>
</html>