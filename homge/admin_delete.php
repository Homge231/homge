<?php
session_start();
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $postId = $_POST['id'];
        $post = getPostById($pdo, $postId);

        // Check if the post exists and if the current user is the owner or an admin
        if ($post && ($post['user_id'] == $_SESSION['user_id'] || $_SESSION['is_admin'] == 1)) {
            deletePostByAdmin($pdo, $postId);
        }

        header('Location: manage_post.php');
        exit;
    }
}


