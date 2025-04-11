<?php
header('Content-Type: application/json');
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get and sanitize input
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            throw new Exception("Invalid input format");
        }

        $fullName = filter_var($input['fullName'] ?? '', FILTER_SANITIZE_STRING);
        $email = filter_var($input['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $input['password'] ?? '';

        // Validate input
        if (empty($fullName) || strlen($fullName) < 2) {
            throw new Exception("Full name must be at least 2 characters long");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        if (strlen($password) < 8) {
            throw new Exception("Password must be at least 8 characters long");
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            throw new Exception("Email already registered");
        }
        $checkStmt->close();

        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullName, $email, $hashedPassword);

        if (!$stmt->execute()) {
            throw new Exception("Failed to create account");
        }

        $userId = $conn->insert_id;
        $stmt->close();

        // Return success response
        echo json_encode([
            "success" => true,
            "message" => "Registration successful",
            "userId" => $userId
        ]);

    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            "success" => false,
            "error" => $e->getMessage()
        ]);
    }

    $conn->close();
} else {
    http_response_code(405);
    echo json_encode([
        "success" => false,
        "error" => "Method not allowed"
    ]);
}
