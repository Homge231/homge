<?php
session_start();
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];
$user = getUserById($pdo, $userId);

// Fetch posts for the logged-in user
$posts = getPostsByUserId($pdo, $userId); // Assume this function retrieves posts by user_id

$title = 'Profile';

ob_start();
include 'templates/profile.html.php';
$output = ob_get_clean();
include 'templates/profile_layout.html.php';
?>
