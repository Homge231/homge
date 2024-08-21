<?php
session_start();
require 'includes/DatabaseConnection.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query to fetch user data
    $stmt = $pdo->prepare('SELECT id, password_hash, is_admin FROM users WHERE username = :username');
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and password is correct
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin'];

        // Redirect based on admin status
        if ($_SESSION['is_admin'] == 1) {
            header('Location: admin_home.php');
        } else {
            header('Location: home.php');
        }
        exit;
    } else {
        $_SESSION['message'] = ['text' => 'Invalid username or password', 'alert' => 'danger'];
        header('Location: index.php');
        exit;
    }
}
?>
