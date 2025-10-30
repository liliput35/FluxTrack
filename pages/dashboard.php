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

        <!-- SANTI GIAN TABLE -->
        <!-- CIOCON edit for STYLES -->

        <div class="main-content flex-md-fill p-md-3 pt-md-5">
            <?php include('../includes/mobile-header.php') ?>
            
            <div class="main-content-container w-90 mx-auto mx-md-0 w-md-100">
                <p class="page-info"> <img src="../assets/images/blue-home-icon.png" alt=""><span>Home  /  Dashboard</span></p>
                
                <div class="dashboard-cards my-4 d-md-grid gap-md-3">
                    <div class="recent-incident dash-card dash-card-left">
                        <h4>Recent Incident</h4>
                        <h2>Air Conditioning Failure</h2>

                        <div class="recent-bot-card ">
                            <div class="recent-left">
                                <p class="recent-labels">Reporter Name</p>
                                <p>Miguel Reyes</p>

                                <p class="recent-labels">Status</p>
                                <p>In Progress</p>

                                <p class="recent-labels">Remark</p>
                                <p>Fixed wiring of air conditioner</p>
                            </div>
                            <div class="recent-right">
                                <p class="recent-labels">Date</p>
                                <p>Oct 11, 2025</p>

                                <p class="recent-labels">Time</p>
                                <p>10:45 AM</p>

                                <p class="recent-labels">Location</p>
                                <p>1st Floor, Grocery</p>
                            </div>
                        </div>
                    </div>

                    <div class="dash-card-right">
                        <div class="total-incidents dash-card">
                            <h4>Total Incidents this Month</h4>
                            <h1 class="text-center">42</h1>
                            <p class="red-text">up 16% vs September</p>
                            <p class="total-labels">Most Reported</p>
                            <p>Wet Floor (28%)</p>
                            <p class="total-labels">Peak Day</p>
                            <p>Oct 12 (7 Incidents)</p>
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