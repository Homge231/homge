<?php
session_start();
require_once 'conn.php';

if (isset($_POST['register'])) {
    if (!empty($_POST['name']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        try {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO users (name, username, email, password_hash) VALUES (:name, :username, :email, :password_hash)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':name' => $name, ':username' => $username, ':email' => $email, ':password_hash' => $passwordHash]);

            $_SESSION['message'] = ["text" => "User successfully created.", "alert" => "info"];
            $conn = null;
            header('location:index.php');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        $_SESSION['error'] = 'Please fill up the required field!';
        header('Location: registration.php');
        exit;
    }
}
?>
