<?php
session_start();
require 'includes/DatabaseConnection.php';
require 'includes/DatabaseFunctions.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get the post_id to show comments if present
$postIdToShowComments = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

// Fetch all posts with user data and comments
$posts = getAllPostsWithUsersAndComments($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'], $_POST['comment'])) {
    $postId = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
    $userId = $_SESSION['user_id'];

    if ($userId !== null) {
        addComment($pdo, $postId, $userId, $comment);
        header('Location: posts.php');
        exit;
    } else {
        echo 'User not logged in.';
    }
}

$title = 'Posts';
ob_start();
include 'templates/posts.html.php';
$output = ob_get_clean();
include 'templates/layout.html.php';

