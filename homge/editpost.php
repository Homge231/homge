<?php
session_start();
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

try {
    if (!isset($_GET['id'], $_SESSION['user_id'])) {
        header('Location: posts.php');
        exit;
    }


    $post = getPostById($pdo, $_GET['id']);
    if (!$post || $post['user_id'] != $_SESSION['user_id']) {
        header('Location: posts.php');
        exit;
    }

   
    $modules = getAllModules($pdo);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
        $moduleId = filter_input(INPUT_POST, 'module_id', FILTER_VALIDATE_INT);
        $imageUrl = $post['image_url'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageUrl = basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'],'img/'. $imageUrl);
        }

        updatePost($pdo, $post['id'], $title, $content, $imageUrl, $moduleId);
        header('Location: posts.php');
        exit;
    } else {
        $title = 'Edit post';
        ob_start();
        include 'templates/editpost.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'An error has occurred, please try again later: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>
