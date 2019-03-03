<?php
require_once("dbinfo.php");
require_once("config.php");

session_start();
$username = "";
$password = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


if( isset( $_POST["username"]) && isset($_POST["password"]) && $_POST["username"] != "" && $_POST["password"] != "" ){

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    
    $escapedUserName = $mysqli->real_escape_string($username);

    $query = "SELECT username, password FROM users WHERE BINARY username='$escapedUserName'";
    $result = $mysqli->query($query);
    $userOfInterest = $result->fetch_assoc();
    $userNameFromDB = $userOfInterest["username"];
    $userPassFromDB = $userOfInterest["password"];

	if( $userNameFromDB != $escapedUserName ){
		//if username is no good, store an error message into a session
		$_SESSION["errors"] .= "<p>User Name does not exist, please double check your User Name</p>";		
	}	
	//ensure password is acceptable
	if( !password_verify($password, $userPassFromDB) ){
		//if password is no good, store an error message into a session
		$_SESSION["errors"] .= "<p>Password is invalid! Please try again..</p>";				
	}	
}else{
	//if the user did not use the form, 
	//store an appropriate error message into a session
	$_SESSION["errors"] .= "<p>Please fill in this form: </p>";		
}

//if the $_SESSION["errors"] is set,
//then at least one error has occurred...
if(isset($_SESSION["errors"])){
	//... so send the user back to the form to try again
	header("location: index.php");
	die();
}else{
	//if the $_SESSION["errors"] is NOT set,
	//then log this user in...
	$_SESSION["timeLastActive"] = time();	
	
	//determine if this user wishes to be remembered or not
	//if so, use a cookie to do so
	//if not, delete any cookies that may have been set in the past
	if(isset($_POST["rememberme"])) {
		setcookie("username", $username, time()+60*60*24, "/");
	} else {
		setcookie("username", "", time()-1, "/");
	}
	
	
	
	//now use sessions to store any important information
	//for other pages to access...
	
	//create a secure session id that cannot be 'guessed'
	$_SESSION["strong_id"] = session_id() . $_SERVER["HTTP_USER_AGENT"] . "SalTStr1111ng";
	//remember user information
	$_SESSION["username"]  	= $username;
	$_SESSION["widget"] = 0;
	$_SESSION["doohickey"] = 0;
	$_SESSION["thingamajig"] = 0;
	
	//from processing complete and successful
	//forward the user to the storefront
	header("location: content.php"); 	
	die();
}
	
?>
