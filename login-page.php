<!-- Torres 10-29-2025 -->
<!-- This page contains the login form and login logic -->
<!-- Code by: MJ Torres -->

<?php 
  session_start();
  include('./includes/db_connect.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'] ?? '';
      $password = $_POST['password'] ?? '';

      $sql = "SELECT * FROM users WHERE username = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          $user = $result->fetch_assoc();
          if (password_verify($password, $user['password'])) {
              $_SESSION['user_id'] = $user['user_id'];
              $_SESSION['username'] = $user['username'];
              $_SESSION['role'] = $user['role'];
              header("Location: ./pages/dashboard.php");
              exit;
          } else {
              $error_message = "Invalid username or password.";
          }
      } else {
          $error_message = "Invalid username or password.";
      }

      $stmt->close();
      $conn->close();
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
    <!-- CIOCON BOOTSTRAP 10-28 -->
    <div class="vh-100 login-container main-container d-md-flex align-items-md-center">
      
      <div class="login-row d-md-flex">
        <div class="login-left rounded-4 me-md-5"></div>

        <div class="login-right">
          <div class="img-container d-flex justify-content-center py-3 w-md-100">
            <img src="./assets/images/logo.png" alt="">
          </div>

          <!-- MJ LOG IN  10-28 -->
          <h2 class="fw-bold">Log In</h2>
          <p>Enter your username and password to access your account </p>

          <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
          <?php endif; ?>

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
