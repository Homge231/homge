<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
    <title>Profile</title>
</head>
<body>
    <div class="profile-container">
        <div class="profile-info">
            <img src="img/<?= htmlspecialchars($user['avatar'], ENT_QUOTES, 'UTF-8') ?>" alt="Avatar" class="profile-avatar">
            <div class="profile-details">
                <h2><?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?></h2>
                <p class="profile-bio"><?= htmlspecialchars($user['bio'], ENT_QUOTES, 'UTF-8') ?></p>
                <a href="profile_edit.php" class="edit-profile-btn">Edit Profile</a>
                <a href="addpost.php" class="edit-profile-btn">Add New Post</a>
            </div>
        </div>

        <!-- Assuming you want to display a list of posts here -->
        <div class="posts-container">
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <h2 class="post-title"><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <p class="post-content"><?php echo htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php if (!empty($post['image_url'])): ?>
                <img src="img/<?php echo htmlspecialchars($post['image_url'], ENT_QUOTES, 'UTF-8'); ?>" alt="Post Image" class="post-image">
            <?php endif; ?>
            <div class="post-actions">
                <a href="editpost.php?id=<?= htmlspecialchars($post['id'], ENT_QUOTES, 'UTF-8') ?>" class="btn-edit">Edit</a>
                <form action="deletepost.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($post['id'], ENT_QUOTES, 'UTF-8') ?>">
                    <button type="submit" class="btn-delete">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

    </div>
</body>
</html>
