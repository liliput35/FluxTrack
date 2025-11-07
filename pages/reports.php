<!-- ERIKA -->
<!-- GET REFERENCE FROM dashboard.php on how to connect db to page -->
<!-- sql select query from dashboard outputs only 5. dont limit it here output all -->
 
<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
    header("Location: ../login-page.php");
    exit;
    }

    include('../includes/db_connect.php');

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
                    ORDER BY incidents.incident_id DESC" ;
            $table_header = 'All' ;
        } else {
            $sql = "SELECT incidents.incident_id, incidents.description, users.name AS reporter_name, incidents.location, incidents.date, incidents.time, incidents.status, incidents.remarks  
                    FROM incidents
                    LEFT JOIN users ON incidents.reported_by = users.user_id
                    WHERE incidents.role_assigned_to = '$user_role' 
                    ORDER BY incidents.incident_id DESC";
            $table_header = $user_role ;
        }
        
        $result_incidents = mysqli_query($conn, $sql);
        $role_condition = ($user_role != 'Admin') ? "AND incidents.role_assigned_to = '$user_role'" : "";


        // Default: If there are incidents
        $oldest_date = '-';
        $newest_date = '-';

        $date_range_sql = "
            SELECT MIN(date) AS oldest, MAX(date) AS newest
            FROM incidents
            WHERE 1=1 $role_condition
        ";

        $date_result = mysqli_query($conn, $date_range_sql);
        if ($date_result && mysqli_num_rows($date_result) > 0) {
            $row = mysqli_fetch_assoc($date_result);
            if ($row['oldest'] && $row['newest']) {
                $oldest_date = date("j M", strtotime($row['oldest'])); // e.g., 1 Sept
                $newest_date = date("j M Y", strtotime($row['newest'])); // e.g., 20 Sept 2025
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>

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
                <p class="page-info"> <img src="../assets/images/blue-report-icon.png" alt=""><span>Reports  /  Incidents</span></p>

                <h2 class="page-heading"><?= $table_header?> Incidents</h2>
                

                <div class="table-search-group">
                    <div class="top-search">
                        <input type="text" id="searchInput" placeholder="Search..."> 

                        <div class="filter-date">
                            <p><?= $oldest_date ?> - <?= $newest_date ?></p>
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

<script>
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.querySelector(".incident-table tbody");

    searchInput.addEventListener("keyup", function() {
        let query = this.value;

        fetch(`../includes/search_incidentsFull.php?q=` + encodeURIComponent(query))
            .then(res => res.text())
            .then(data => {
                tableBody.innerHTML = data;
            });
    });
</script>

<script src="../assets/js/main.js"></script>


<?php include('../includes/footer.php') ?>