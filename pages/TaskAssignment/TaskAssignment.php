<?php
ob_start();
session_start();

    require "MessageArlet.php";
    require "../light/config.php";
    $NumofSales = ''; 
    $StatusSalesID = '';
    $NumLeadsSales = '';
	
    $sql2 = "select  COUNT(*) as sum
            from dbo.AssignTask";
    $stmt2 = sqlsrv_query( $conn, $sql2 ); 

    $num = 0;
    while( $row = sqlsrv_fetch_array( $stmt2,  SQLSRV_FETCH_BOTH) ) 
	{
                    $num = $num + $row['sum'];		
	}
        
    $sql_salescount = "SELECT COUNT(*) as sum
                        from dbo.Sales_Rep";
    $stmtSalesCount = sqlsrv_query($conn,$sql_salescount);
    $totalsales = sqlsrv_fetch_array($stmtSalesCount);
    $NumofSales =  $totalsales['sum'];
        
    if(isset($_POST['SelectNames']))
    {
        $StatusSalesID = $_POST['SelectNames'];
       // echo $StatusSalesID;
    }
    if(isset($_POST['leadsnum']))
    {
        $NumLeadsSales = $_POST['leadsnum'];
      //  echo $NumLeadsSales;
    }


    $NumLeadsSales ='';
    if(isset($_POST['leadsnum']))
    {
        $NumLeadsSales = $_POST['leadsnum'];
      //  echo $NumLeadsSales;
    }
    
    require "../light/config.php";
    $sql3= "select * from dbo.sales_rep";
    $stmt3 = sqlsrv_query( $conn, $sql3 );

    while( $row = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC) ) 
    {	
        $tes[]=$row['SalesID'];
    }

    //NO. of Assign task
    $sql8= "select * from dbo.AssignTask";
    $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt8 = sqlsrv_query($conn, $sql8, $params, $options);
	 $task=sqlsrv_num_rows($stmt8);
	//echo '<br>';
    if($task>0)
    {
        $sql1='select distinct c.CustID from Customer c, AssignTask a
        where c.CustID not in (select AssignTask.custid from AssignTask)';
    }
    else 
    {
        //NO. of customer
        $sql1= "select * from dbo.customer";
    }
    $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt7 = sqlsrv_query($conn, $sql1, $params, $options);
	 $customer=sqlsrv_num_rows($stmt7);
	//echo '<br>';
	
    //No of Sales
    $sql1= "select * from dbo.sales_rep";
    $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt2 = sqlsrv_query($conn, $sql1, $params, $options);
	  $sales=sqlsrv_num_rows($stmt2);
	//echo '<br>';
        

		 $div=$customer/$sales;
		 $div=(int)$div;
		//echo '<br>';
                $div=(int)$div;
                
            /* if(isset($_POST['leadsnum']))
                {
                    if($div >  $NumLeadsSales)
                    {
                        $div = (int)$div - (int)$NumLeadsSales;
                    }
                }  */      
// echo $customer; echo '<br>'; echo $sales; echo '<br>'; echo $div;           
                
if(isset($_POST['SalesSubmit']))
   {
if($div>0)
{
    //getting no. of customers
    $count=0;
    $sales1=0;

if($task>0)
{
    $sql13='select distinct c.CustID from Customer c, AssignTask a
            where c.CustID not in (select AssignTask.custid from AssignTask)';
}
else 
{
//NO. of customer
    $sql13= "select * from dbo.customer";
}

    $stmt13 = sqlsrv_query( $conn, $sql13 );
	while( $row = sqlsrv_fetch_array( $stmt13, SQLSRV_FETCH_ASSOC) ) 
		{
			  $cust=$row['CustID'];
			
			if($count>=$NumLeadsSales)
			{
				$count=0;
				
				 $sales1+=1;
				if($sales1>=$sales)
				break;
				//echo '<br>';
			}
			$sql6= "select * from dbo.[AssignTask]";
    $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt6 = sqlsrv_query($conn, $sql6, $params, $options);
	if (sqlsrv_num_rows($stmt6) >= 1)
{
	while( $row = sqlsrv_fetch_array( $stmt6, SQLSRV_FETCH_ASSOC) ) 
		{
			
			$temp= explode("A",$row['tsID']);
			
			
			
		}
		$temp[1]+=1;
		$num = 123;
$str_length = 3;

// hardcoded left padding if number < $str_length
$leadID= substr("0000{$temp[1]}", -$str_length);

// output: 0123
		
		//$custID="L".$temp[1];
		 $leadID="A".$leadID;
		 }
		 else
		 $leadID="A001";
		 
		  
			
			
	$sql8= "INSERT INTO dbo.AssignTask
        (tsID,SalesID, stMonth, custid)
        VALUES ('$leadID','$tes[$sales1]', getdate(), '$cust');";
    $stqr = sqlsrv_query( $conn, $sql8 );  
    if( $stqr === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
            echo $sql8;
        }
    }
}
			//echo '<br>';
			$count++;
		}
}

    else 
     {
        $error='Not enough members to assign tasks';
        echo "<script type='text/javascript'>alert(\"$error\");</script>";
        
     }
}		
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
<style>
#mypadding{
  background:#bed6c8;
  width:800px;
  height:200px;
  margin:1em;
}
.padding{
  padding: 15px 30px;
  background:red;
}
</style>
    </head>
    <link href="MessageArletCss.css" rel="stylesheet" type="text/css">
    <body onkeypress="handleEnter(event)">
    <legend><h5 align="center"><font  color="navy" face="Segoe" size="+6">Task Distribution </font></h5></legend>
    <br><br><br><br><br><br>
    
       
    <form action="TaskAssignment.php" method="POST" id="myForm">   

    <div id="mypadding" class="padding">
    <label name="lblMonth"><font  color="#d14d47" face="Segoe" size="+2">
    <b>Warning: </b> You have maximum of <b> <?php echo  str_repeat('&nbsp;', 1); echo $div; ?> </b> Tasks to assigned to every consultant and <b> <?php echo $NumofSales; echo '<br>'; echo str_repeat('&nbsp;', 17); ?> </b> overall number of Sales available.</font></label><br><br>

    Enter Number of Tasks: 
    <input size="2" type="text" name="leadsnum" value="" onblur="TBlur(this.id);" id="leadsnum" focus required>
     <br><br>     
    Month: 
    <input style="font-weight:bold" size="4"type="text" name="Sales_ID" value="<?php echo date("F"); ?> " readonly><br><br>    
    <br>
    
   
    <input type="submit" onClick="validate()" name="SalesSubmit" value="Submit" >

   </div>
        
        <script type="text/javascript">
        
            document.addEventListener('DOMContentLoaded', init, false);
            
            function init()
            {
 	 	function message () 
        	{
                    
                    var numOfLeads = '<?php echo (int)$div ;?>';
                    var checkvalue = document.getElementById('leadsnum').value;

                    if(checkvalue > numOfLeads)
                    {    
 			alert("Your Value is greater the number of Leads");
                        document.getElementById('leadsnum').value = "";
                    }
                    else if(checkvalue ==0 && checkvalue != "")
                    {
                        document.getElementById('leadsnum').value = "";
                        alert("Your value must be greater than Zero");
                    }
                    else 
                    {}
  		}   
                document.getElementById('leadsnum').value = "";
                var button = document.getElementById('leadsnum');
 		button.addEventListener('blur', message, true);
            };
			
            
    </script> 
     <script type="text/javascript">
	 function validate(){
		 
		                     var numOfLeads = '<?php echo (int)$div ;?>';
                    var checkvalue = document.getElementById('leadsnum').value;

                    if(checkvalue > numOfLeads)
                    {    
 			alert("Your Value is greater the number of Leads");
                        document.getElementById('leadsnum').value = "";
                    }
                    else if(checkvalue ==0 && checkvalue != "")
                    {
                        document.getElementById('leadsnum').value = "";
                        alert("Your value must be greater than Zero");
                    }
                    else 
                    {}
		 
/*if(!Form1.F1.value)
{
     return();
}
else
{
   
}*/
	 }
	 // handle enter plain javascript
function handleEnter(e){
    var keycode = (e.keyCode ? e.keyCode : e.which);
    if (keycode == '13') {
      validate();
    }
}
</script>
    
    </form> 
    </body>
        <script type="text/javascript">
//Place as last thing before the closing </body> tag
if(location.search.indexOf('reloaded=yes') < 0){
    var hash = window.location.hash;
    var loc = window.location.href.replace(hash, '');
    loc += (loc.indexOf('?') < 0? '?' : '&') + 'reloaded=yes';
    // SET THE ONE TIME AUTOMATIC PAGE RELOAD TIME TO 5000 MILISECONDS (5 SECONDS):
    setTimeout(function(){window.location.href = loc + hash;}, 500);
}
</script>
</html>