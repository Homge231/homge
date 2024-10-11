<?php
session_start();
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

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

        // Redirect to posts page
        header('Location: posts.php');
        exit;

    } catch (Exception $e) {
        $title = 'An error has occurred';
        $output = 'Sorry, there was an error adding the post: ' . $e->getMessage();
    }
} else {
    $modules = getAllModules($pdo);

    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
        <link rel="stylesheet" href="css/profile_edit.css">
    </head>
    <body>
        <main>
            <div class="profile-edit-container">
                <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
                <form action="addpost.php" method="post" enctype="multipart/form-data">
                    <div class="input-box">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" required>
                    </div>
                    <div class="input-box">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" rows="4" required></textarea>
                    </div>
                    <div class="input-box">
                        <label for="module_id">Module</label>
                        <select name="module_id" id="module_id">
                            <?php foreach ($modules as $module): ?>
                                <option value="<?= htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8') ?>">
                                    <?= htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" accept="image/*">
                    </div>
                    <button type="submit">Add Post</button>
                </form>
            </div>
        </main>
    </body>
    </html>
    <?php
    $output = ob_get_clean();
    include 'templates/profile_layout.html.php';
}
?>
