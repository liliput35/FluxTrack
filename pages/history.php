<!-- GIAN -->
<!-- GET REFERENCE FROM dashboard.php on how to connect db to page -->
<!-- sql select query from dashboard outputs only 5. dont limit it here output all -->
<!-- output only if incident.status = 'Resolved' -->

<!---- GIAN -->
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login-page.php");
    exit;
}

include('../includes/db_connect.php');

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Get user role
    $sql = "SELECT role FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_role = htmlspecialchars($row['role']);
    }

    // Build query based on role, filtering for Resolved incidents
    if ($user_role == 'Admin') {
        $sql = "SELECT incidents.incident_id, incidents.description, users.name AS reporter_name, incidents.location, incidents.date, incidents.time, incidents.status, incidents.remarks 
                FROM incidents
                LEFT JOIN users ON incidents.reported_by = users.user_id 
                WHERE incidents.status = 'Resolved'
                ORDER BY incidents.incident_id DESC";
        $table_header = 'All Resolved';
    } else {
        $sql = "SELECT incidents.incident_id, incidents.description, users.name AS reporter_name, incidents.location, incidents.date, incidents.time, incidents.status, incidents.remarks  
                FROM incidents
                LEFT JOIN users ON incidents.reported_by = users.user_id
                WHERE incidents.role_assigned_to = '$user_role' 
                AND incidents.status = 'Resolved'
                ORDER BY incidents.incident_id DESC";
        $table_header = "$user_role Resolved";
    }

    $result_incidents = mysqli_query($conn, $sql);
    $role_condition = ($user_role != 'Admin') ? "AND incidents.role_assigned_to = '$user_role'" : "";

    // Get date range of resolved incidents
    $oldest_date = '-';
    $newest_date = '-';

    $date_range_sql = "
        SELECT MIN(date) AS oldest, MAX(date) AS newest
        FROM incidents
        WHERE status = 'Resolved' $role_condition
    ";

    $date_result = mysqli_query($conn, $date_range_sql);
    if ($date_result && mysqli_num_rows($date_result) > 0) {
        $row = mysqli_fetch_assoc($date_result);
        if ($row['oldest'] && $row['newest']) {
            $oldest_date = date("j M", strtotime($row['oldest']));
            $newest_date = date("j M Y", strtotime($row['newest']));
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
    <div class="layout d-md-flex w-md-100">
        <?php include('../includes/navbar.php') ?>
        <?php include('../includes/mobile-navbar.php') ?>


        <div class="main-content flex-md-fill p-md-3 pt-md-5">
            <?php include('../includes/mobile-header.php') ?>
            
            <div class="main-content-container w-90 mx-auto mx-md-0 w-md-100">
                <p class="page-info"> <img src="../assets/images/blue-history-icon.png" alt=""><span>History  /  Incidents</span></p>

                <h2 class="page-heading">Completed Reports</h2>
                

                <div class="table-search-group">
                    <div class="top-search">
                        <input type="text" placeholder="Search..."> 

                        <div class="filter-date">
                            <p>1 Sept - 20 Sept 2025</p>
                        </div>
                    </div>

                    <div class="bot-search">
                        <button class="edit-btn" id="toggleEditMode">Edit</button>
                    </div>
                </div>
                
                <table class="incident-table">
                    <thead>
                    <tr class="header-row">
                        <th scope="col">No</th>
                        <th scope="col">Incident Type</th>
                        <th scope="col">Reporter Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Remarks</th>
                        <th class="edit-col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_incidents && mysqli_num_rows($result_incidents) > 0) {
                            $counter = 1;
                            while ($incident = mysqli_fetch_assoc($result_incidents)) {
                                echo "<tr>";
                                echo "<th scope='row' data-label='No'>{$counter}</th>";
                                echo "<td data-label='Incident Type'>" . htmlspecialchars($incident['description']) . "</td>";
                                echo "<td data-label='Reporter Name'>" . htmlspecialchars($incident['reporter_name']) . "</td>";
                                echo "<td data-label='Location'>" . htmlspecialchars($incident['location']) . "</td>";
                                echo "<td data-label='Date'>" . date("M j, Y", strtotime($incident['date'])) . "</td>";
                                echo "<td data-label='Time'>" . date("g:i A", strtotime($incident['time'])) . "</td>";
                                echo "<td data-label='Status' class='resolved-incident'><span class='badge bg-success'>Resolved</span></td>";
                                echo "<td data-label='Remarks'>" . htmlspecialchars($incident['remarks']) . "</td>";
                                echo "<td class='edit-cell'></td>";
                                echo "</tr>";
                                $counter++;
                            }
                        } else {
                            echo "<tr><td colspan='9'>No resolved incidents found.</td></tr>";
                        }
                        ?>
                        </tbody>   
                </table>
            </div>

        </div>
        
    </div>
        
</body>

<script src="../assets/js/main.js"></script>


<?php include('../includes/footer.php') ?>