<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/post.css">
        <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
    </head>
    <body>
        <header>
            <h1>Admin </h1>

        </header>
          <nav>
            <ul>
              <li><a href="admin_home.php">Home</a></li>
              <li><a href="manage_post.php">Manage Posts</a></li>
              <li><a href="manage_user.php">Manage Users/Module</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </nav>
        <main>
            <?php echo isset($output) ? $output : ''; ?>
        </main>
    </body>
</html>
