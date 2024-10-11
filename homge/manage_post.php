<?php
session_start();
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

// Fetch all posts from the database
$posts = getAllPosts($pdo);

ob_start();
$title = 'Manage Posts';
include 'templates/manage_post.html.php';
$output = ob_get_clean();
include 'templates/admin_layout.html.php';
?>
