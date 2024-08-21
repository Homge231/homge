    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <link rel="stylesheet" href="css/post.css">
            <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
        </head>
        <body>
            <header>
                <h1>Homge Forum</h1>
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
                <?php echo isset($output) ? $output : ''; ?>
            </main>
        </body>
    </html>
