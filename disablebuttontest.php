<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<input type="submit" name="submit" value="submit" id="myBtn">

<p>Click the button below to disable the button above.</p>

<button onclick="myFunction()">Try it</button>
<button onclick="myFunction1()">Able button</button>

<script>
function myFunction() {
    document.getElementById("myBtn").disabled = true;
}
</script>	`

<script>
function myFunction1() {
    document.getElementById("myBtn").disabled = false;
}
</script>

</body>
</html>