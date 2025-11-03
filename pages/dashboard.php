<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
    header("Location: ../login-page.php");
    exit;
    }

    include('../includes/db_connect.php');

    //if user is logged in get role 

    if(isset($_SESSION['user_id'])){ 
        $user_id = $_SESSION['user_id'] ; 

        $sql = "SELECT role FROM users WHERE user_id = $user_id";
        $result = mysqli_query($conn, $sql); 

        if($result && mysqli_num_rows($result) > 0){ 
            $row = mysqli_fetch_assoc($result); 
            $user_role = htmlspecialchars($row['role']);
        }

        if ($user_role == 'Admin') {
            $sql = "SELECT incidents.incident_id, incidents.description, users.name AS reporter_name, incidents.location, incidents.date, incidents.time, incidents.status, incidents.remarks 
                    FROM incidents
                    LEFT JOIN users ON incidents.reported_by = users.user_id 
                    ORDER BY incidents.incident_id DESC 
                    LIMIT 5" ;
            $table_header = 'All' ;
        } else {
            $sql = "SELECT incidents.incident_id, incidents.description, users.name AS reporter_name, incidents.location, incidents.date, incidents.time, incidents.status, incidents.remarks  
                    FROM incidents
                    LEFT JOIN users ON incidents.reported_by = users.user_id
                    WHERE incidents.role_assigned_to = '$user_role' 
                    ORDER BY incidents.incident_id DESC 
                    LIMIT 5";
            $table_header = $user_role ;
        }
        
        $result_incidents = mysqli_query($conn, $sql);


        
        if ($user_role == 'Admin') {
            
            $recent_sql = "
                SELECT incidents.description, incidents.location, incidents.date, incidents.time, incidents.status, incidents.remarks, users.name AS reporter_name
                FROM incidents
                LEFT JOIN users ON incidents.reported_by = users.user_id
                ORDER BY incidents.incident_id DESC
                LIMIT 1
            ";
        } else {
            
            $recent_sql = "
                SELECT incidents.description, incidents.location, incidents.date, incidents.time, incidents.status, incidents.remarks, users.name AS reporter_name
                FROM incidents
                LEFT JOIN users ON incidents.reported_by = users.user_id
                WHERE incidents.role_assigned_to = '$user_role'
                ORDER BY incidents.incident_id DESC
                LIMIT 1
            ";
        }

        $recent_result = mysqli_query($conn, $recent_sql);

        $recent_incident = null;
        if ($recent_result && mysqli_num_rows($recent_result) > 0) {
            $recent_incident = mysqli_fetch_assoc($recent_result);
        }

        if ($recent_incident) {
            $recent_description = htmlspecialchars($recent_incident['description']);
            $recent_reporter = htmlspecialchars($recent_incident['reporter_name']);
            $recent_status = htmlspecialchars($recent_incident['status']);
            $recent_remarks = htmlspecialchars($recent_incident['remarks']);
            $recent_date = date("M d, Y", strtotime($recent_incident['date']));
            $recent_time = date("g:i A", strtotime($recent_incident['time']));
            $recent_location = htmlspecialchars($recent_incident['location']);
        } else {
            $recent_description = "No incidents yet.";
            $recent_reporter = "-";
            $recent_status = "-";
            $recent_remarks = "-";
            $recent_date = "-";
            $recent_time = "-";
            $recent_location = "-";
        }

        // Admin or role-based filtering
        $role_condition = ($user_role != 'Admin') ? "AND incidents.role_assigned_to = '$user_role'" : "";

        // October total
        $october_sql = "
            SELECT COUNT(*) AS total_incidents
            FROM incidents
            WHERE MONTH(date) = 10 AND YEAR(date) = YEAR(CURDATE()) $role_condition
        ";
        $october_result = mysqli_query($conn, $october_sql);
        $october_total = 0;
        if ($october_result && mysqli_num_rows($october_result) > 0) {
            $row = mysqli_fetch_assoc($october_result);
            $october_total = (int)$row['total_incidents'];
        }

        // September total
        $september_sql = "
            SELECT COUNT(*) AS total_incidents
            FROM incidents
            WHERE MONTH(date) = 9 AND YEAR(date) = YEAR(CURDATE()) $role_condition
        ";
        $september_result = mysqli_query($conn, $september_sql);
        $september_total = 0;
        if ($september_result && mysqli_num_rows($september_result) > 0) {
            $row = mysqli_fetch_assoc($september_result);
            $september_total = (int)$row['total_incidents'];
        }


        $peak_day_sql = "
            SELECT date, COUNT(*) AS incidents_count
            FROM incidents
            WHERE MONTH(date) = 10 AND YEAR(date) = YEAR(CURDATE()) $role_condition
            GROUP BY date
            ORDER BY incidents_count DESC
            LIMIT 1
        ";
        $peak_day_result = mysqli_query($conn, $peak_day_sql);
        $peak_day = ['date' => '-', 'count' => 0];
        if ($peak_day_result && mysqli_num_rows($peak_day_result) > 0) {
            $row = mysqli_fetch_assoc($peak_day_result);
            $peak_day = [
                'date' => date("M d", strtotime($row['date'])),
                'count' => (int)$row['incidents_count']
            ];
        }

    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

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
                <p class="page-info"> <img src="../assets/images/blue-home-icon.png" alt=""><span>Home  /  Dashboard</span></p>
                
                <div class="dashboard-cards my-4 d-md-grid gap-md-3">
                    <div class="recent-incident dash-card dash-card-left">
                        <h4>Recent Incident</h4>
                        <h2><?= $recent_description ?></h2>

                        <div class="recent-bot-card">
                            <div class="recent-left">
                                <p class="recent-labels">Reporter Name</p>
                                <p><?= $recent_reporter ?></p>

                                <p class="recent-labels">Status</p>
                                <p><?= $recent_status ?></p>

                                <p class="recent-labels">Remark</p>
                                <p><?= $recent_remarks ?></p>
                            </div>
                            <div class="recent-right">
                                <p class="recent-labels">Date</p>
                                <p><?= $recent_date ?></p>

                                <p class="recent-labels">Time</p>
                                <p><?= $recent_time ?></p>

                                <p class="recent-labels">Location</p>
                                <p><?= $recent_location ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="dash-card-right">
                        <div class="total-incidents dash-card">
                            <h4>Total Incidents this Month</h4>
                            <h1 class="text-center"><?= $october_total ?></h1>
                            <p class="red-text">Last Month: <?= $september_total ?></p>
                            <p class="total-labels">Most Reported</p>
                            <p>Wet Floor (28%)</p>
                            <p class="total-labels">Peak Day</p>
                            <p><?= $peak_day['date'] ?> (<?= $peak_day['count'] ?> Incidents)</p>
                        </div>

                        <div class="right-right-col">
                            <div class="percentage dash-card">
                                <h4>Percentage of Resolved Incidents</h4>
                                <h2>78%</h2>
                                <p class="green-text">12% improvement vs September</p>
                            </div>
                            <div class="average-time dash-card">
                                <h4>Average Response Time</h4>
                                <h2>2h 15m</h2>
                                <p>Fastest: <span class="green-text">35m</span></p>
                                <p>Slowest: <span class="red-text">6h</span></p>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>

                <h2><?= $table_header?> Incidents</h2>
                <div class="table-search-group">
                    <div class="top-search">
                        <input type="text" placeholder="Search..."> 

                        <div class="filter-date">
                            <p>1 Sept - 20 Sept 2025</p>
                        </div>
                    </div>

                    <div class="bot-search">
                        <button class="edit-btn" id="toggleEditMode">Edit</button>
                        <a href="./add-incident.php">+</a>
                    </div>
                </div>
                
                <table class="incident-table">
                    <thead>
                    <tr class="header-row">
                        <th scope="col">No</th>
                        <th scope="col">Incident Type</th>
                        <th scope="col">Reporter Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Location</th>
                        <th scope="col">Status</th>
                        <th scope="col">Remarks</th>
                        <th class="edit-col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php  
                            if ($result_incidents && mysqli_num_rows($result_incidents) > 0) {  
                                $count = 1;  
                                while ($row = mysqli_fetch_array($result_incidents)) {  
                                    // Extract fields
                                    $incidentId = htmlspecialchars($row['incident_id']);
                                    $description = htmlspecialchars($row['description']);
                                    $reporter = htmlspecialchars($row['reporter_name']);
                                    $location = htmlspecialchars($row['location']);
                                    $date = date("M d, Y", strtotime($row['date']));
                                    $time = date("g:i A", strtotime($row['time']));
                                    $status = htmlspecialchars($row['status']);
                                    $remarks = htmlspecialchars($row['remarks']);

                                    // Choose badge color
                                    $badgeClass = '';
                                    if ($status == 'Resolved') $badgeClass = 'bg-success';
                                    elseif ($status == 'Ongoing') $badgeClass = 'bg-warning';
                                    else $badgeClass = 'bg-danger';

                                    echo "
                                    <tr data-id='{$incidentId}'>
                                        <th scope='row' data-label='No'>{$count}</th>
                                        <td data-label='Incident Type'>{$description}</td>
                                        <td data-label='Reporter Name'>{$reporter}</td>
                                        <td data-label='Date'>{$date}</td>
                                        <td data-label='Time'>{$time}</td>
                                        <td data-label='Location'>{$location}</td>
                                        <td data-label='Status'><span class='badge {$badgeClass}'>{$status}</span></td>
                                        <td data-label='Remarks'>{$remarks}</td>
                                        <td class='edit-cell'></td>   
                                    </tr>
                                    ";
                                    $count++;
                                }
                            } else {
                                echo "
                                <tr>
                                    <td colspan='9' class='text-center'>No incidents found.</td>
                                </tr>";
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