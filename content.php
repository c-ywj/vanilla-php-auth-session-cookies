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

    require_once("dbinfo.php");
    require_once("config.php");
    session_start();
    require_once("securityGuard.php");

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if( mysqli_connect_errno() != 0 ){
        die("<p>Could not connect to DB</p>");	
    }

    $query = "SELECT username FROM users;";
    $results = $mysqli->query( $query );

echo "<table>";
    while( $oneRecord = $results->fetch_assoc() ) {
        echo "<tr>".
             "<td>".$oneRecord["username"]."</td>".
             "</tr>";
    }
echo "</table>";

?>

<p><a href="logout.php">Logout</a></p>
    
</body>
</html>