<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <header>
        <h1>Home Forum</h1>
        <ul class="logout-menu">
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </header>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="posts.php">Post List</a></li>
            <li><a href="profile.php">Profile</a></li>
        </ul>
    </nav>
    <main>
        <?= isset($output) ? $output : '' ?>
    </main>
</body>
</html>

