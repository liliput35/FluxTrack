
<!-- CIOCON CREATE ACCOUNT  10-14 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    
</head>
<body>
    <div class="vh-100 login-container main-container d-md-flex align-items-md-center">
      <div class="login-row d-md-flex">
        <div class="login-left rounded-4 me-md-5"></div>

        <div class="login-right">
          <div class="img-container d-flex justify-content-center py-3 w-md-100">
            <img src="../assets/images/logo.png" alt="">
          </div>

          
          <h2 class="fw-bold">Create your Account</h2>


          <form method="POST">
            <label for="username">Name</label> <br>
            <div class="create-name-group">
                <input class="first-name" type="text" name="firstname" placeholder="First Name" required>
                <input type="text" name="lastname" placeholder="Last Name" required>
            </div>
            <br>
           

            <label for="username">Username</label> <br>
            <input type="text" name="username" placeholder="Enter your username" required><br><br>
            
            <label for="password">Password</label> <br>
            <input type="password" name="password" placeholder="Enter your password" required><br><br>
            
            <input type="submit" value="Create Account" class="submit-btn">
          </form>

          <p class="create-noacc text-center">Already have an account? <span><a href="../login-page.php">Log In</a></span></p> 
          

        </div>
      </div>
    </div>
    
</body>


<?php include('../includes/footer.php') ?>
