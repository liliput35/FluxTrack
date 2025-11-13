<!-- CHUA 11-3-2025 -->
<!-- This page contains the form for editing and incident and handling logic for UPDATING and DELETING incidents -->
<!-- Code by: Gabrielle Mia Chua -->


<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login-page.php");
        exit;
    }

    include('../includes/db_connect.php');
    $user_id = $_SESSION['user_id'];
    $user_role = '';

    if(isset($_SESSION['user_id'])){ 
        // Fetch user role
        $sql = "SELECT role FROM users WHERE user_id = $user_id";
        $result = mysqli_query($conn, $sql); 

        if($result && mysqli_num_rows($result) > 0){ 
            $row = mysqli_fetch_assoc($result); 
            $user_role = htmlspecialchars($row['role']);
        }
    }
    

    if (isset($_GET['incidentId'])) {
        $id = $_GET['incidentId'];
        $sql_fetch = "SELECT * FROM incidents WHERE incident_id = $id";
        $result = mysqli_query($conn, $sql_fetch);

        if ($result-> num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $incident = $row['description'];
                $location = $row['location'];
                $reported_by_id = $row['reported_by'] ;
                $date = $row['date'];
                $time = $row['time'];
                $role_assigned_to = $row['role_assigned_to'];
                $status = $row['status'];
                $remarks = $row['remarks'];
            }
        }

        //get reporter name 
        $reported_by_sql = "SELECT name FROM users WHERE user_id = $reported_by_id" ; 
        $reported_by_result = mysqli_query($conn, $reported_by_sql) ; 

        if($reported_by_result && mysqli_num_rows($reported_by_result) > 0){ 
            $row = mysqli_fetch_assoc($reported_by_result); 
            $reporter_name = htmlspecialchars($row['name']);
        }
    }

    if(isset($_POST['update'])) {
         $new_status = isset($_POST['status']) && $_POST['status'] !== '' ? $_POST['status'] : $status;

        //CHECK FOR STATUS CHANGE 
        if($status != $new_status && $new_status == 'Resolved'){ 
            $old_status = $status ; 

            $sql_status = "INSERT INTO incident_status_updates 
                            (incident_id, updated_by, old_status, new_status, old_timestamp, updated_timestamp) 
                            VALUES ($id, $user_id, '$old_status', '$new_status', (CONCAT('$date', ' ', '$time')), NOW())" ;
            
            $sql_status_result = mysqli_query($conn, $sql_status) ; 

        }


        $incident = $_POST['incident_type'];
        $location = $_POST['location'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $role_assigned_to = !empty($_POST['assigned_department']) ? $_POST['assigned_department'] : $role_assigned_to;
        $status = !empty($_POST['status']) ? $_POST['status'] : $status;
        $remarks = $_POST['remarks'];

        $sql_update = "UPDATE incidents 
                        SET description = '$incident', location = '$location', date = '$date', time = '$time', role_assigned_to = '$role_assigned_to', status = '$status', remarks = '$remarks' 
                        WHERE incident_id = '$id'";

        $result = mysqli_query($conn, $sql_update);
        if ($result == TRUE) {
            $response = "Incident Updated Successfully!";
        } else {
            $response = "Error:" . $sql . "<br>" . $conn->error;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Incident</title>

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

                <p class="page-info"> <img src="../assets/images/blue-account-icon.png" alt=""><span>Edit  /  Incident</span></p>

                <h1>Editing Incident</h1>
                
                <h2>Incident Details</h2>

                <div class="incident-details">
                    <form method="POST" action="">
                        <div class="incident-details">
                            <div class="incident-text-inputs">
                                <div class="incident-form-group">
                                    <p>Reporter Name</p>
                                    <input
                                    type="text"
                                    name="reporter_name"
                                    value = "<?php echo $reporter_name; ?>"
                                    placeholder="e.g Juan Cruz"
                                    readonly
                                    />
                                </div>

                                <div class="incident-form-group">
                                    <p>Incident Type</p>
                                    <input
                                    type="text"
                                    name="incident_type"
                                    value = "<?php echo $incident; ?>"
                                    placeholder="e.g Wet Floor"
                                    required
                                    />
                                </div>

                                <div class="incident-form-group">
                                    <p>Location</p>
                                    <input
                                    type="text"
                                    name="location"
                                    value = "<?php echo $location; ?>"
                                    placeholder="e.g 3rd Floor"
                                    required
                                    />
                                </div>

                                <div class="date-time">
                                    <div class="left-date">
                                    <p>Date</p>
                                    <input type="date" name="date" value = "<?php echo $date;?>" required  />
                                    </div>
                                    <div class="right-time">
                                    <p>Time</p>
                                    <input type="time" name="time" value = "<?php echo $time;?>" required />
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
                            <textarea name="remarks" id="remarks" placeholder="Add remarks here..." rows="4"> <?php echo $remarks;?> </textarea>
                            <br />

                            <button type="submit" value= "Update" name= "update" class="submit-btn">File Report</button>
                        </div>
                    </form>
                <?php if ($user_role === 'Admin'): ?>
                    <button data-bs-toggle="modal" data-bs-target="#deleteIncidentModal" class="mt-3 submit-btn delete-btn">Delete Incident</button>


                </div>

                <!-- Delete Incident Modal -->
                <div class="modal fade" id="deleteIncidentModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete <?= $incident?>?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form method="POST" action="../includes/handleDeleteIncident.php">
                                <input type="hidden" name="incident_id" value="<?= $id ?>">

                                <div class="modal-footer">
                                    <button type="submit" name="delete_incident" class="btn btn-danger">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

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