<?php
// Database connection — CAT2 (PostgreSQL via PDO)
$host   = '127.0.0.1';
$port   = '5432';
$dbname = 'CAT2';              // quoted name created in schema.sql
$user   = 'cat2user';
$pass   = 'StrongPass123';     // change this to match your own DB password

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
