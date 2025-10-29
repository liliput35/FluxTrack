<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
    <div class="layout d-md-flex w-md-100">
        <?php include('../includes/navbar.php') ?>
        <?php include('../includes/mobile-navbar.php') ?>


        <div class="main-content account-page flex-md-fill p-md-3 pt-md-5">
            <?php include('../includes/mobile-header.php') ?>
            
            <div class="main-content-container w-90 mx-auto mx-md-0 w-md-100">

                <p class="page-info"> <img src="../assets/images/blue-account-icon.png" alt=""><span>My Account</span></p>

                <div class="account-heading">
                    <img src="../assets/images/blue-account-icon.png" alt="">

                    <div class="pref-name">
                        <p>Preferred Name</p>
                        <input type="text" value="Juan Cruz">
                    </div>
                </div>

                <h2>Personal Information</h2>

                <div class="personal-info">
                    <div class="info-name">
                        <div class="form-group">
                            <p>First Name</p>
                            <input type="text" value="Juan">
                        </div>
                        <div class="form-group">
                            <p>Last Name</p>
                            <input type="text" value="Cruz">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <p>Birthdate</p>
                        <input type="date" >
                    </div>
                    <div class="form-group">
                        <p>Phone Number</p>
                        <input type="text" value="09XX XXX XXXX">
                    </div>

                    <button>Save Changes</button>
                </div>
                <h2>Account Security</h2>

                <div class="account-creds">
                    <div class="account-info">
                        <h4>Username</h4>
                        <p>user123</p>
                    </div>

                    <button>Change Username</button>
                </div>
                
                <div class="account-creds">
                    <div class="account-info">
                        <h4>Password</h4>
                        <p>Set your password</p>
                    </div>

                    <button>Change Password</button>
                </div>
                
            </div>

        </div>
        
    </div>
        
</body>


<?php include('../includes/footer.php') ?>