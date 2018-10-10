<?php
require "configCookie.php";
if(isset($_FILES["file"]["type"]))
{
$validextensions = array("jpeg", "jpg", "png");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
}
else
{
	$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
	$path="profile/".$_COOKIE['username'].".".$ext;
if (file_exists($path)) {
	unlink($path);

}

$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
$targetPath = $path; // Target path where file is to be stored
move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
echo '<div id="success" class="alert alert-success">uploaded successfully (please refresh the page)</div>';
//echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
//echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
//echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
//echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
$name=$_COOKIE['username'].".".$ext;
$ema=$_COOKIE['username'];
$sql="UPDATE [dbo].[Sales_Rep]
   set [Profile_Picture] = '$name'
 WHERE S_Emails='$ema'";
 
 $stmt = sqlsrv_query( $conn, $sql);

}
}
else
{
echo "<span id='invalid'>***Invalid file Size or Type***<span>";
}
}
?>