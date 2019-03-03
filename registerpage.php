<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

<?php 

session_start();

if(isset($_SESSION["errors"])){
	//if so, display them now
	echo "<h2>Form processing errors:</h2>";
	echo $_SESSION["errors"];
	//and clear the errors from memory after they ahve been displayed
	unset($_SESSION["errors"]);
}
?>

    <div>
        <form action="processRegistration.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id=username/>
            <br/>
            <label for="password">Password:</label>
            <input type="password" name="password" id=password/>
            <br/>
            <label for="passwordRetyped">Re-Enter Password:</label>
            <input type="password" name="passwordRetyped" id=passwordRetyped/>
            <br/>
            <input type="submit"/>
        </form>
    </div>

    <p>Already a member? <a href="index.php">Log in here!</a></p>

    
</body>
</html>