<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="css/manage_post.css">
</head>
<body>
    <div class="manage-users">
        <h1>Manage Users</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <form action="manage_user.php" method="POST" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="manage-modules">
        <h1>Manage Modules</h1>
        <form action="manage_user.php" method="POST">
            <input type="hidden" name="module_action" value="add">
            <input type="text" name="module_name" placeholder="New Module Name" required>
            <button type="submit" class="btn-add">Add Module</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($modules as $module): ?>
                <tr>
                    <td><?php echo htmlspecialchars($module['id']); ?></td>
                    <td><?php echo htmlspecialchars($module['module_name']); ?></td>
                    <td>
                        <form action="manage_user.php" method="POST" style="display:inline;">
                            <input type="hidden" name="module_action" value="update">
                            <input type="hidden" name="module_id" value="<?= htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <input type="text" name="module_name" value="<?= htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8') ?>" required>
                            <button type="submit" class="btn-update">Update</button>
                        </form>
                        <form action="manage_user.php" method="POST" style="display:inline;">
                            <input type="hidden" name="module_action" value="delete">
                            <input type="hidden" name="module_id" value="<?= htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
