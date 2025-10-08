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

</head>
<body>
    <!-- MJ LOG IN -->
    <h2>Login</h2>
    <form method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br><br>
    
    <label for="password">Password:</label>
    <input type="password" name="password" required><br><br>
    
    <input type="submit" value="Login">
    </form>
</body>


<?php include('./includes/footer.php') ?>
