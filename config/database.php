<?php
// Debug environment variables
error_log("DB_HOST: " . (getenv('DB_HOST') ?: 'not set'));
error_log("DB_NAME: " . (getenv('DB_NAME') ?: 'not set'));
error_log("DB_USER: " . (getenv('DB_USER') ?: 'not set'));
error_log("DB_PASS: " . (getenv('DB_PASS') ?: 'not set'));

$db_host = getenv('DB_HOST') ?: 'db';
$db_name = getenv('DB_NAME') ?: 'ai_guide';
$db_user = getenv('DB_USER') ?: 'postgres';
$db_pass = getenv('DB_PASS') ?: 'postgres';

$dsn = "pgsql:host=$db_host;dbname=$db_name";
error_log("Attempting to connect with DSN: $dsn");

try {
    $pdo = new PDO($dsn, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_log("Database connection successful!");
} catch(PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    die("Connection failed: " . $e->getMessage());
}
?> 