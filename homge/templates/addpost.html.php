<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile_edit.css">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
</head>
<body>
    <main>
        <div class="container">
            <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
            <form action="addpost.php" method="post" enctype="multipart/form-data">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>

                <label for="content">Content</label>
                <textarea name="content" id="content" rows="4" required></textarea>

                <label for="module_id">Module</label>
                <select name="module_id" id="module_id">
                    <?php foreach ($modules as $module): ?>
                        <option value="<?= htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="image">Image</label>
                <input type="file" name="image" id="image" accept="image/*">

                <input type="submit" value="Add Post">
            </form>
        </div>
    </main>
</body>
</html>
