<?php // 10/30/25 Torres
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login-page.php");
        exit;
    }

    include('../includes/db_connect.php');
    $user_id = $_SESSION['user_id'];
    $message = '';

    
    // Handle Personal Info Update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_personal_info'])) {
        $first_name = $_POST['first_name'] ?? '';
        $last_name = $_POST['last_name'] ?? '';
        $name = trim($first_name . ' ' . $last_name);
        $role = $_POST['role'] ?? '';

        if (!empty($name) && !empty($role)) {
            $update_sql = "UPDATE users SET name = ?, role = ? WHERE user_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ssi", $name, $role, $user_id);
            if ($update_stmt->execute()) {
                $message = "Personal information updated successfully!";
            }
            $update_stmt->close();
        }
    }

    // Handle Username Change
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_username'])) {
        $new_username = $_POST['new_username'] ?? '';
        if (!empty($new_username)) {
            // Check if username already exists
            $check_sql = "SELECT user_id FROM users WHERE username = ? AND user_id != ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bind_param("si", $new_username, $user_id);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();
            if ($check_result->num_rows == 0) {
                $update_sql = "UPDATE users SET username = ? WHERE user_id = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("si", $new_username, $user_id);
                if ($update_stmt->execute()) {
                    $_SESSION['username'] = $new_username;
                    $message = "Username changed successfully!";
                }
                $update_stmt->close();
            } else {
                $message = "Username already taken.";
            }
            $check_stmt->close();
        }
    }

    // Handle Password Change
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
        $current_password = $_POST['current_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        $sql = "SELECT password FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user_data = $result->fetch_assoc();
        $stmt->close();

        if ($user_data && password_verify($current_password, $user_data['password'])) {
            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_sql = "UPDATE users SET password = ? WHERE user_id = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("si", $hashed_password, $user_id);
                if ($update_stmt->execute()) {
                    $message = "Password changed successfully!";
                }
                $update_stmt->close();
            } else {
                $message = "New passwords do not match.";
            }
        } else {
            $message = "Incorrect current password.";
        }
    }

    // Fetch user data for display
    $sql = "SELECT name, role, username FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    $conn->close();

    if ($user) {
        $name_parts = explode(' ', $user['name'], 2);
        $first_name = $name_parts[0] ?? '';
        $last_name = $name_parts[1] ?? '';
    } else {
        // Fallback in case user is not found
        $user = ['name' => 'N/A', 'role' => 'N/A', 'username' => 'N/A'];
        $first_name = '';
        $last_name = '';
    }
?>


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
                        <p>Name</p>
                        <input type="text" value="<?php echo htmlspecialchars($user['name']); ?>" readonly>
                    </div>
                </div>

                <h2>Personal Information</h2>

                <div class="personal-info">
                    <form method="post">
                        <div class="info-name">
                            <div class="form-group">
                                <p>First Name</p>
                                <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>">
                            </div>
                            <div class="form-group">
                                <p>Last Name</p>
                                <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <p>Role</p>
                            <input type="text" name="role"  value="<?php echo htmlspecialchars($user['role']); ?>">
                        </div>

                         <button type="submit" name="save_personal_info">Save Changes</button>
                    </form>
                </div>
                <h2>Account Security</h2>

                <div class="account-creds">
                    <div class="account-info">
                        <h4>Username</h4>
                        <p><?php echo htmlspecialchars($user['username']); ?></p>
                    </div>

                    <button data-bs-toggle="modal" data-bs-target="#changeUsernameModal">Change Username</button>

                </div>
                
                <div class="account-creds">
                    <div class="account-info">
                        <h4>Password</h4>
                        <p>Set your password</p>
                    </div>

                    <button data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>   
                </div>

                <a href="../includes/logout.php" class="text-black">LOG OUT</a>
                
            </div>

            <!-- Change Username Modal -->
            <div class="modal fade" id="changeUsernameModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Change Username</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form method="POST">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="new_username" class="form-label">New Username</label>
                                    <input type="text" class="form-control" name="new_username" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="change_username" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Change Password Modal -->
            <div class="modal fade" id="changePasswordModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Change Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form method="POST">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" class="form-control" name="current_password" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-control" name="new_password" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" name="confirm_password" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="change_password" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
        
    </div>
        
</body>


<?php include('../includes/footer.php') ?>