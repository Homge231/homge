<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="css/edit.css">
</head>
<body>
    <div class="container">
        <h1>Edit Post</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" required><?= htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>

            <div class="form-group">
                <label for="module_id">Module:</label>
                <select id="module_id" name="module_id" required>
                    <?php foreach ($modules as $module): ?>
                        <option value="<?= htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8') ?>"
                                <?= $module['id'] == $post['module_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <?php if ($post['image_url']): ?>
                    <div class="image-preview">
                        <img src="img/<?= htmlspecialchars($post['image_url'], ENT_QUOTES, 'UTF-8') ?>" alt="Current Image">
                        <p class="image-label">Current image</p>
                    </div>
                <?php endif; ?>
                <input type="file" id="image" name="image">
            </div>

            <div class="form-group">
                <button type="submit" class="submit-btn">Update Post</button>
            </div>
        </form>
    </div>
</body>
</html>
