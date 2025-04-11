<?php
session_start();
header('Content-Type: application/json');
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get and sanitize input
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            throw new Exception("Invalid input format");
        }

        $email = filter_var($input['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $input['password'] ?? '';

        // Validate input
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        if (empty($password)) {
            throw new Exception("Password is required");
        }

        // Get user by email
        $stmt = $conn->prepare("SELECT id, full_name, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Invalid email or password");
        }

        $user = $result->fetch_assoc();
        $stmt->close();

        // Verify password
        if (!password_verify($password, $user['password'])) {
            throw new Exception("Invalid email or password");
        }

        // Update last login time
        $updateStmt = $conn->prepare("UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE id = ?");
        $updateStmt->bind_param("i", $user['id']);
        $updateStmt->execute();
        $updateStmt->close();

        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['email'] = $user['email'];

        // Remove password from response
        unset($user['password']);
        
        // Add session timestamp
        $user['loginTime'] = date('c');

        // Return success response
        echo json_encode([
            "success" => true,
            "message" => "Login successful",
            "user" => $user
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
