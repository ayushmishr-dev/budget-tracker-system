-- Create the database
CREATE DATABASE IF NOT EXISTS budget_tracker;
USE budget_tracker;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    UNIQUE INDEX email_idx (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add indexes for performance
CREATE INDEX IF NOT EXISTS users_email_password_idx ON users(email, password);
CREATE INDEX IF NOT EXISTS users_created_at_idx ON users(created_at);
