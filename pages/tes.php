<?php

require "config.php";
$sql3=" select distinct datename(MM,date_created) as date ,
group by (date) date_created from lead order by max(date)";
$verify = sqlsrv_query( $conn, $sql3 );
while( $row = sqlsrv_fetch_array( $verify,  SQLSRV_FETCH_BOTH) ) 
		{	 echo $price=$row['date'];
				
			}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" href="build.css">


  <script src="bootstrap-checkbox.min.js" defer></script>
</head>

<body>
<div class="container">
<h1>Checkboxes style by using plugin</h1>
                    <div class="checkbox">
                        <input id="check1" type="checkbox" class="styled" checked>
                        <label for="check1">
                            A simple checkbox
                        </label>
                    </div>
                    <div class="checkbox checkbox-warning">
                        <input id="check2" type="checkbox" class="styled" checked>
                        <label for="check2">
                            Style 2
                        </label>
                    </div>

                    <div class="checkbox checkbox-primary">
                        <input id="check3" class="styled" type="checkbox" checked>
                        <label for="check3">
                            Style 3
                        </label>
                    </div>
                    
                    <div class="checkbox checkbox-info">
                        <input id="check4" class="styled" type="checkbox" checked>
                        <label for="check4">
                            Style 4
                        </label>
                    </div>
                    
                    <div class="checkbox checkbox-success">
                        <input id="check5" class="styled" type="checkbox" checked>
                        <label for="check5">
                            Style 5
                        </label>
                    </div>
                    
                    <div class="checkbox checkbox-danger">
                        <input id="check6" class="styled" type="checkbox" checked>
                        <label for="check6">
                            Style 6
                        </label>
                    </div>
                    
                    <div class="checkbox checkbox-circle">
                        <input id="check7" class="styled" type="checkbox" checked>
                        <label for="check7">
                            Style 7 (Rounded)
                        </label>
                    </div>
                    <div class="checkbox checkbox-info checkbox-circle">
                        <input id="check8" class="styled" type="checkbox" checked>
                        <label for="check8">
                            Style 8 (Rounded)
                        </label>
                    </div>                    

</div>

 
</body>
<?php ;?>
</html>


