<?php
session_start();
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
    $userId = $_SESSION['user_id'];

    try {
        addComment($pdo, $postId, $userId, $comment);
        header('Location: posts.php');
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'An error has occurred, please try again later: ' . $e->getMessage();
    }
}
?>
