$(document).ready(function (e) {
$("#regis").on('submit',(function(e) {
e.preventDefault();

var pass2 = document.getElementById("confirmpassword");
var pass1 = document.getElementById("password");


$("#mess").empty();
$('#load').show();
if(pass1.value===pass2.value && pass1.value!=="")
{
$.ajax({
url: "regu.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
$('#load').hide();
$("#mess").html(data);
 $("input[type=text]").val('');
  $("input[type=password]").val('');
   $("input[type=email]").val('');
   $("input[type=tel]").val('');

}
});

}
else{
	$('#load').hide();
	$("#mess").append('<div id="success" style="width:300px"  class="alert alert-danger">Incorrect Password</div>');
	$("#mess").fadeOut(3000);
//alert("wrong password");
}
}));


});