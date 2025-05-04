<?php
// File: public/include/db.php

// Database configuration
$dbHost = 'localhost';
$dbUser = 'username';
$dbPass = 'password';
$dbName = 'dams_db';

// Create connection
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set
$conn->set_charset("utf8mb4");