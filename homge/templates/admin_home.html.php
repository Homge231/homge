<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/post.css">
    <title>Welcome</title>
    <script>
        function updateDateTime() {
            const now = new Date();
            const dateTimeString = now.toLocaleString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            });
            document.getElementById('date-time').textContent = dateTimeString;
        }

        window.onload = function() {
            updateDateTime();
            setInterval(updateDateTime, 1000); 
        };
    </script>
</head>
<body>
    <header>
        <h1>Welcome back, <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>!</h1>
    </header>
    <main>
        <p>Current date and time: <span id="date-time"></span></p>
    </main>
    <footer>
        &copy; <?= date('Y') ?> Homge. All rights reserved.
    </footer>
</body>
</html>
