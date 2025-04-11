<?php
$host = "localhost";
$user = "root"; // Change this to your MySQL username
$pass = "";     // Change this to your MySQL password
$db   = "budget_tracker";

try {
    $conn = new mysqli($host, $user, $pass, $db);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    // Log error and show user-friendly message
    error_log("Database connection error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(["error" => "Unable to connect to database. Please try again later."]);
    exit;
}
