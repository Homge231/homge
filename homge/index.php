<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form </title>
  <link rel="stylesheet" href="css/styles.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <div class="wrapper">
    <form action="login_query.php" method="POST">
      <h1>Login</h1>
      <div class="input-box">
        <input type="text" placeholder="Username" name="username" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Password" name="password" required>
        <i class='bx bxs-lock-alt' ></i>
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox" name="remember">Remember Me</label>

      </div>
      <button type="submit" class="btn" name="login">Login</button>
      <div class="register-link">
        <p>Dont have an account? <a href="registration.php">Register</a></p>
      </div>
    </form>
    <?php if (isset($_SESSION['message'])):?>
      <div class="alert alert-<?php echo $_SESSION['message']['alert']?> msg">
        <?php echo $_SESSION['message']['text']?>
      </div>
      <script>
        (function() {
          setTimeout(function() {
            document.querySelector('.msg').remove();
          }, 3000)
        })();
      </script>
    <?php endif; unset($_SESSION['message']);?>
  </div>
</body>
</html>