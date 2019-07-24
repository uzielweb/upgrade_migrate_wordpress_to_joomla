<?php


//public $host = 'localhost';
//public $user = '97fmpontal';
//public $password = 'KUe97HkYenIxevg';
//public $db = 'joomla_97fmpontal';
//public $dbprefix = 'l9md2_';

$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
$dbprefix = "wp_";
$joomlaprefix = "l9md2_";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}