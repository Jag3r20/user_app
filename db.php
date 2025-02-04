<?php
$host = 'localhost';
$dbname = 'marecekf_user_app';
$username = 'marecekf';
$password = 'nesahatmoje';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>