<?php

$server_name = "localhost";
$database_name = "crud";
$username = "root";
$password = "#M.S.Dhoni07@";

try {
    // Create connection
    $conn = new PDO("mysql:host=$server_name;dbname=$database_name", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optionally, print a success message for testing
    // echo "Database connected successfully..!";

} catch (PDOException $e) {
    // Handle connection failure
    echo "Connection failed: " . $e->getMessage();
}
