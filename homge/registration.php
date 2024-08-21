<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link rel="stylesheet" href="css/styles.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <div class="wrapper">
    <form action="register_query.php" method="POST">
      <h1>Registration</h1>
      <div class="input-box">
        <input type="text" placeholder="Name" name="name" required>
        <i class='bx bx-user'></i>
      </div>
      <div class="input-box">
        <input type="text" placeholder="Username" name="username" required>
        <i class='bx bx-user'></i>
      </div>
      <div class="input-box">
        <input type="email" placeholder="Email" name="email" required>
        <i class='bx bx-envelope'></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Password" name="password" required>
        <i class='bx bx-lock-alt'></i>
      </div>
      <button type="submit" class="btn" name="register">Register</button>
      <div class="register-link">
        <p>Already have an account? <a href="index.php">Login</a></p>
      </div>
    </form>
  </div>
</body>
</html>
