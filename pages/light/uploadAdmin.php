<?php
ob_start();
session_start();
 $ivoice=$_GET['ref'];
define ('SITE_ROOT', realpath(dirname(__FILE__)));
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.
if(isset($_FILES['userfile'])){
$uploaddir = './var/'.date("d-F-Y").'/';
$uploadfile = $uploaddir . $ivoice.'.pdf';
if (!file_exists($uploaddir)) {
    mkdir($uploaddir, 0755, true);
}

echo '<pre>';

if (move_uploaded_file($_FILES['userfile']['tmp_name'], SITE_ROOT.$uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}

echo 'Here is some more debugging info:';
print_r($_FILES);

print "</pre>";
}

?>

<!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype="multipart/form-data" action="" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="31457280" />
    <!-- Name of input element determines name in $_FILES array -->
    Send this file: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>