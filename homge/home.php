<?php
session_start();
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

$title = 'Home';

try {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    $userId = $_SESSION['user_id'];
    $user = getUserById($pdo, $userId); 

    $name = $user ? $user['name'] : 'Guest';

    ob_start();
    include 'templates/home.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'An error has occurred, please try again later: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>
