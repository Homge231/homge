<?php
$dsn = 'mysql:host=localhost;dbname=homge';
$db_username = 'root';
$db_password = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
try {
    $conn = new PDO($dsn, $db_username, $db_password, $options);
} catch (PDOException $e) {
    die('Database connection error: ' . $e->getMessage());
}
?>
