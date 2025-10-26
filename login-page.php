<?php // Login Logic - Mj Torres - 10/7/2025
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $valid_username = "admin";
        $valid_password = "secret123";
        
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
    
        if ($username === $valid_username && $password === $valid_password) {
          echo "<h2>Welcome, $username!</h2> 
                <a href='./dashboard.php'>to home</a>";
          exit;
        } else {
          echo "<h2>Invalid username or password.</h2>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    
</head>
<body>
    <!-- CIOCON STYLING  10-8 -->
    <div class="vh-100 login-container main-container">
      <div class="login-row">
        <div class="login-left"></div>

        <div class="login-right">
          <div class="img-container">
            <img src="./assets/images/logo.png" alt="">
          </div>

          <!-- MJ LOG IN  10-7 -->
          <h2>Log In</h2>
          <p>Enter your username and password to access your account </p>
          <form method="POST">
            <label for="username">Username</label> <br>
            <input type="text" name="username" placeholder="Enter your username" required><br><br>
            
            <label for="password">Password</label> <br>
            <input type="password" name="password" placeholder="Enter your password" required><br><br>
            
            <input type="submit" value="Login" class="submit-btn">
          </form>

          <!-- CIOCON 10-14-->
          <p class="login-noacc text-center">Don't have an account? <span><a href="./pages/create-page.php">Sign Up</a></span></p> 
          

        </div>
      </div>
    </div>
    
</body>


<?php include('./includes/footer.php') ?>
