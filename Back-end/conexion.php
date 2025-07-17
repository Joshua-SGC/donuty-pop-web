<?php
$servername = "localhost";
$database = "u456729209_DBdonutypop";
$username = "u456729209_admin_donuty";
$password = "PepeC00?";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>