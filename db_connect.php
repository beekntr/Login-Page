<?php
$servername = "srv1497.hstgr.io";
$username = "u188323907_lester";
$password = "#Dgisweakgamer1";
$dbname = "u188323907_login_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
