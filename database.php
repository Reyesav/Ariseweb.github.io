<?php

$hostName = "sql307.infinityfree.com";
$dbUser = "if0_36112772";
$dbPassword ="KZ6WUAu6PlorUl9";
$dbName = "if0_36112772_reyes";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName );
If (!$conn) {
die("Something went wrong!");
}

?>