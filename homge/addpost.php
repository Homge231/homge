<?php
session_start();

include_once 'includes/DatabaseConnection.php';
include_once 'includes/DatabaseFunctions.php';

$title = 'Add Post';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['content'], $_POST['module_id'])) {
    try {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception('User not logged in.');
        }
        $userId = $_SESSION['user_id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $module_id = $_POST['module_id'];

        $imageUrl = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageUrl = basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . $imageUrl);
        }

        insertPost($pdo, $userId, $title, $content, $imageUrl, $module_id);


        header('Location: posts.php');
        exit;

    } catch (Exception $e) {
        $title = 'An error has occurred';
        $output = 'Sorry, there was an error adding the post: ' . $e->getMessage();
    }
} else {

    $modules = getAllModules($pdo);
    

    ob_start();
    include 'templates/addpost.html.php';
    $output = ob_get_clean();
}


include 'templates/layout.html.php';
?>
