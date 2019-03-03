<!DOCTYPE html>
<html>
<head>
		<title>SSD PHP Lab03 Sample</title>
		<link rel="stylesheet" href="http://bcitcomp.ca/ssd/css/style.css" />
	</head>
	<body>
		<h1>SSD PHP Lab03 Sample</h1>
		<h2>Logout</h2>
		<span>
<?php
//all pages that use sessions must run session_start()
session_start();
//see if there are any error messages in the session...
if(isset($_SESSION["errors"])){
	//if so, display them now
	echo $_SESSION["errors"];
	//and clear the errors from memory after they ahve been displayed
	unset($_SESSION["errors"]);
}

//clear each of the several session variables from memory
unset($_SESSION);

//stop tracking this user entirely
session_destroy();

?>			
	</span>
	<p><a href="index.php">Return to the login page</a></p>

	</body>
</html>
