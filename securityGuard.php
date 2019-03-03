<?php
/*
this file is used by storefont.php
to detemine if we will allow the user to access the storefront
or if we will forward them elsewhere
*/


// - 1 - ensure this user is the same one we logged in on authorize_login.php	
if(isset($_SESSION["strong_id"])){
	//re-create the secure session id 
	$strong_id_now = session_id() . $_SERVER["HTTP_USER_AGENT"] . "SalTStr1111ng";
	//compare the $strong_id_now with the $_SESSION["strong_id"] created during login
	if($strong_id_now  != $_SESSION["strong_id"]){
		//if they are different, then something went wrong
		//this is not the same person we logged in!
		//save this information into a session...
		$_SESSION["errors"] .= "<p>Huh? You are not the person who logged in.</p>";	
		//...and log this person out
		header("location: logout.php");
		die();	
	}	
}else{
	$_SESSION["errors"] .= "<p>You need to log in before shopping in our store.</p>";	
	//...and log this person out
	header("location: index.php");
	die();		
}

// - 2 - ensure the user hasn't timed out yet due to inactivity	

if( time() - $_SESSION['timeLastActive'] > TIMEOUT_SECONDS ){
	
	//timeout expired, log this user out
	$_SESSION = array();
	session_destroy();
}else{
	
	//update the time last active
	$_SESSION['timeLastActive']= time();
}
?>