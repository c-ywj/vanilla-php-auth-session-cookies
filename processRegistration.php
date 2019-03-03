<?php 

$username;
$password;
$passwordRetyped;

require_once("dbinfo.php");
require_once("config.php");

session_start();

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if( mysqli_connect_errno() != 0 ){
    die("<p>Could not connect to DB</p>");	
}

if(isset($_SESSION["errors"])){
	echo "<h2>Form processing errors:</h2>";
	echo $_SESSION["errors"];
	unset($_SESSION["errors"]);
}


if( isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["passwordRetyped"]) ){

	$username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $passwordRetyped = trim($_POST["passwordRetyped"]);

	if( strlen($username) < MINIMUM_LENGTH_USERNAME ){
        $_SESSION["errors"] .= "<p>Username must be at least ".MINIMUM_LENGTH_USERNAME." characters</p>";
	}else {
        $query = "SELECT username FROM users WHERE username='$username'";
        $result = $mysqli->query( $query );		
        $affected = $mysqli->affected_rows;
        if($affected == 0) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $insertQuery = "INSERT INTO users (username, password) VALUES ( '$username' , '$hashedPassword' )";
            $insertRowsAffected = $mysqli->query($insertQuery);
        }else {
            $_SESSION["errors"] .= "<p>The User Name has already been taken</p>";
        }
    }

	if( strlen($password) < MINIMUM_LENGTH_PASSWORD ){
		$_SESSION["errors"] .= "<p>Password must be at least 8 characters long</p>";				
    }
    
    if( $password != $passwordRetyped ) {
        $_SESSION["errors"] .= "<p>Passwords must match!</p>";
    }
    
}else{
	$_SESSION["errors"] .= "<p>Please fill in this form: </p>";		
}


if(isset($_SESSION["errors"])){
	header("location: registerpage.php");
	die();
}else{

	$_SESSION["timeLastActive"] = time();	
	
	$_SESSION["strong_id"] = session_id() . $_SERVER["HTTP_USER_AGENT"] . "SalTStr1111ng";
	$_SESSION["username"]  	= $username;
	
	header("location: index.php"); 	
	die();
}

?>