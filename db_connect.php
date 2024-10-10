<?php
// db_connect.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online appointment"; // Database name should be without the .sql extension

function getConnection() {
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>
