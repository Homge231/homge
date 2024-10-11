<?php
session_start();
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

// Fetch all users
$users = getAllUsers($pdo);

// Fetch all modules
$modules = manageModule($pdo, 'fetch_all');

// Handle module actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
        $userId = $_POST['user_id'];
        // Ensure the admin is not trying to delete themselves
        if ($userId != $_SESSION['user_id']) {
            deleteUser($pdo, $userId);
        }
        header('Location: manage_user.php');
        exit;
    } elseif (isset($_POST['module_action'])) {
        $action = $_POST['module_action'];
        
        if ($action === 'add' && !empty($_POST['module_name'])) {
            manageModule($pdo, 'add', null, $_POST['module_name']);
        } elseif ($action === 'update' && !empty($_POST['module_id']) && !empty($_POST['module_name'])) {
            manageModule($pdo, 'update', $_POST['module_id'], $_POST['module_name']);
        } elseif ($action === 'delete' && !empty($_POST['module_id'])) {
            manageModule($pdo, 'delete', $_POST['module_id']);
        }
        header('Location: manage_user.php');
        exit;
    }
}

ob_start();
$title = 'Manage Users';
include 'templates/manage_user.html.php';
$output = ob_get_clean();
include 'templates/admin_layout.html.php';
?>
