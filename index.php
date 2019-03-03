<!DOCTYPE html>
<html>
<head>
		<title>SSD PHP Lab03 Sample</title>
		<link rel="stylesheet" href="http://bcitcomp.ca/ssd/css/style.css" />
	</head>
	<body>
			<h1>SSD PHP Lab03 Sample</h1>
			<span>
<?php

require_once("dbinfo.php");
require_once("config.php");
session_start();

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if( mysqli_connect_errno() != 0 ){
	die("<p>Could not connect to DB</p>");	
}

$query = "SELECT username FROM users;";
$result = $mysqli->query( $query );

$user = "";
$checkedOrNot = "";
//see if there are any error messages in the session...
if(isset($_SESSION["errors"])){
	//if so, display them now
	echo "<h2>Form processing errors:</h2>";
	echo $_SESSION["errors"];
	//and clear the errors from memory after they ahve been displayed
	unset($_SESSION["errors"]);
}

if(isset($_COOKIE["username"]) && $_COOKIE["username"] != "") {
	$user = $_COOKIE["username"];
	$checkedOrNot = "checked='checked'";
} else {
	$checkedOrNot = "";
}
?>			
			</span>
			
	<form action="processLogin.php" method="post">
		<input 	type="text" 
				name="username" 
				value="<?php echo $user ?>"
				id="username"  />
		<label 	for="username">Username</label> <small>*required*</small><br />

		<input 	type="password" 
				name="password" 
				id="password" />
		<label 	for="password">Password</label> <small>*required* (note: <em>bcit</em> is the only accepted password)</small><br />

		<input	type="checkbox"
				<?php echo $checkedOrNot; ?>
				name="rememberme"
				id="rememberme" />
		<label for="rememberme">Remember Me</label>
		<br />
		<input type="submit" value="Submit" />
	</form>
	
	<p>Not a member? <a href="registerpage.php">Register now!</a></p>

	</body>
</html>
