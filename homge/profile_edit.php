<?php
session_start();
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

$userId = $_SESSION['user_id'];
$user = getUserById($pdo, $userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $bio = filter_input(INPUT_POST, 'bio', FILTER_SANITIZE_STRING);
    $avatarUrl = $user['avatar'];

    // Handle avatar upload
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $avatarUrl = basename($_FILES['avatar']['name']);
        move_uploaded_file($_FILES['avatar']['tmp_name'], 'img/' . $avatarUrl);
    }

    // Update profile information
    updateUserProfile($pdo, $userId, $name, $avatarUrl, $bio);

    // Redirect to avoid form resubmission
    header('Location: profile.php');
    exit;
}

$title = 'Edit Profile';

ob_start();
?>
<div class="profile-edit-container">
    <form action="profile_edit.php" method="POST" enctype="multipart/form-data">
        <h1>Edit Profile</h1>
        <div class="input-box">
            <label for="name">Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?>" required>
        </div>
        <div class="input-box">
            <label for="bio">Bio</label>
            <textarea name="bio" rows="3" required><?= htmlspecialchars($user['bio'], ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>
        <div class="input-box">
            <label for="avatar">Avatar</label>
            <input type="file" name="avatar">
            <img src="img/<?= htmlspecialchars($user['avatar'], ENT_QUOTES, 'UTF-8') ?>" alt="Avatar" class="edit-avatar-preview">
        </div>
        <button type="submit">Save Changes</button>
    </form>
</div>
<?php
$output = ob_get_clean();
include 'templates/profile_layout.html.php';
?>
