<?php
    session_start();
    include('../includes/db_connect.php');

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login-page.php");
        exit;
    }

    // safe to use $_SESSION['user_id'] here
    $user_id = $_SESSION['user_id'];

    $user_sql = "SELECT name, role FROM users WHERE user_id = $user_id";
    $user_result = mysqli_query($conn, $user_sql); 

    if ($user_result && mysqli_num_rows($user_result) > 0) { 
        $row = mysqli_fetch_assoc($user_result); 
        $name = htmlspecialchars($row['name']); 
        $role = htmlspecialchars($row['role']);
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $description = $_POST['incident_type'] ?? '';
        $location = $_POST['location'] ?? '';
        $reported_by = $user_id; 
        $role_assigned_to = $_POST['assigned_department'] ?? '';
        $status = $_POST['status'] ?? '';
        $remarks = $_POST['remarks'] ?? '';
        $date = $_POST['date'] ?? '';
        $time = $_POST['time'] ?? '';

        $sql = "INSERT INTO incidents (description, location, reported_by, role_assigned_to, status, remarks, date, time)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $description, $location, $reported_by, $role_assigned_to, $status, $remarks, $date, $time);

        if ($stmt->execute()) {
            header("Location: add-incident.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }

?>

<!-- SANTI -->
<!-- GET REFERENCE FROM create-page.php on how to connect db to page -->
<!-- use sql INSERT INTO incidents query -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Incident</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
    <div class="layout d-md-flex w-md-100">
        <?php include('../includes/navbar.php') ?>
        <?php include('../includes/mobile-navbar.php') ?>


        <div class="main-content flex-md-fill p-md-3 pt-md-5">
            <?php include('../includes/mobile-header.php') ?>
            
            <div class="main-content-container incident-form w-90 mx-auto mx-md-0 w-md-100">

                <p class="page-info"> <img src="../assets/images/blue-account-icon.png" alt=""><span>Add  /  Incident</span></p>

                <h1>Add Incident</h1>
                
                <h2>Incident Details</h2>

                <!-- (REMOVE THIS PARENTHESIS IF REVERT) <form method="POST" action="add-incident-handler.php"> -->
                    <form method="POST" action="">
                    <div class="incident-details">
                        <div class="incident-text-inputs">
                            <div class="incident-form-group">
                                <p>Reporter Name</p>
                                <input
                                type="text"
                                name="reporter_name"
                                value="<?= $name ?>"
                                readonly
                                />
                            </div>

                            <div class="incident-form-group">
                                <p>Incident Type</p>
                                <input
                                type="text"
                                name="incident_type"
                                placeholder="e.g Wet Floor"
                                required
                                />
                            </div>

                            <div class="incident-form-group">
                                <p>Location</p>
                                <input
                                type="text"
                                name="location"
                                placeholder="e.g 3rd Floor"
                                required
                                />
                            </div>

                            <div class="date-time">
                                <div class="left-date">
                                <p>Date</p>
                                <input type="date" name="date" required />
                                </div>
                                <div class="right-time">
                                <p>Time</p>
                                <input type="time" name="time" required />
                                </div>
                            </div>
                        </div>

                        <p>Assigned Department</p>
                        <div class="department-btns">
                            <input type="radio" id="dept_ops" name="assigned_department" value="Operations" hidden />
                            <button type="button" data-target="dept_ops">Operations</button>

                            <input type="radio" id="dept_eng" name="assigned_department" value="Engineering" hidden />
                            <button type="button" data-target="dept_eng">Engineering</button>

                            <input type="radio" id="dept_house" name="assigned_department" value="Housekeeping" hidden />
                            <button type="button" data-target="dept_house">Housekeeping</button>

                            <input type="radio" id="dept_sec" name="assigned_department" value="Security" hidden />
                            <button type="button" data-target="dept_sec">Security</button>
                        </div>

                        <p>Status</p>
                        <div class="status-btns">
                            <input type="radio" id="status_unresolved" name="status" value="Unresolved" hidden />
                            <button type="button" data-target="status_unresolved">Unresolved</button>

                            <input type="radio" id="status_ongoing" name="status" value="Ongoing" hidden />
                            <button type="button" data-target="status_ongoing">Ongoing</button>

                            <input type="radio" id="status_resolved" name="status" value="Resolved" hidden />
                            <button type="button" data-target="status_resolved">Resolved</button>
                        </div>

                        <p>Remarks</p>
                        <textarea name="remarks" id="remarks" placeholder="Add remarks here..." rows="4"></textarea>
                        <br />

                        <button type="submit" class="submit-btn">File Report</button>
                    </div>
                </form>
            </div>

        </div>
        
    </div>
    

    <script>
        document.querySelectorAll('.department-btns button').forEach(btn => {
        btn.addEventListener('click', () => {
            const group = btn.parentElement;
            group.querySelectorAll('button').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const radio = document.getElementById(btn.dataset.target);
            if (radio) radio.checked = true;
        });
        });

        document.querySelectorAll('.status-btns button').forEach(btn => {
        btn.addEventListener('click', () => {
            const group = btn.parentElement;
            group.querySelectorAll('button').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const radio = document.getElementById(btn.dataset.target);
            if (radio) radio.checked = true;
        });
        });
    </script>
</body>


<?php include('../includes/footer.php') ?>