	<?php	$text_message='<a href="192.168.176.50/crm/getref.php?ref='.$_SESSION['invNO'].'" class="button">Click Here to confirm your Purchase</a>';
$message;

  // HTML email starts here
   
   $message  = "<html> <head><style>.button {
    background-color: ##CCCC00;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
</style> </head><body>";
   
   $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
   
   $message .= "<tr><td>";
   
   $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
    
   $message .= "<thead>
      <tr height='80'>
       <th colspan='4' style='background-color:#CCCC00; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >IKWORX</th>

      </tr>
      </thead>";
	  	     $message .= "<tbody>
			  <tr>
       <td colspan='4' style='padding:15px;'>
        <p style='font-size:20px;'>Hi".$full_name.",</p>
        <hr />
		".$invoiceMessage."
           <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>".$text_message."</p>
        <img src='https://4.bp.blogspot.com/-8RZhFSqg5sY/WnmnpMcfTnI/AAAAAAAAQBQ/K4Joy6pFXncx5IFMcoMlArdmMfRD7GoNgCLcBGAs/s320/godfrey.jpg' alt='Please Upgrade your email client' title='Confirm Order' style='height:auto; width:100%; max-width:100%;' />
     
       </td>
      </tr>
		 
		
		 
		 
		 </tbody>";
    
  
   $message .= "</table>";
   
   $message .= "</td></tr>";
   $message .= "</table>";
   
   $message .= "</body></html>";
   echo $message;
   ?>
