<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => true,
        'user' => [
            'id' => $_SESSION['user_id'],
            'full_name' => $_SESSION['full_name'],
            'email' => $_SESSION['email']
        ]
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Not logged in'
    ]);
}
