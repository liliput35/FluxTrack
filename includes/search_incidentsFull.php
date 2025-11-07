<?php
session_start();
include './db_connect.php';

// Get user role to apply role_condition
$user_id = $_SESSION['user_id'];

$role_sql = "SELECT role FROM users WHERE user_id = $user_id";
$role_result = mysqli_query($conn, $role_sql);
$user_role = mysqli_fetch_assoc($role_result)['role'];

$role_condition = ($user_role != 'Admin') ? "AND incidents.role_assigned_to = '$user_role'" : "";

$q = isset($_GET['q']) ? trim($_GET['q']) : "";

// If search is empty , match dashboard LIMIT 5
if ($q === "") {
    $sql = "
        SELECT incidents.incident_id, incidents.description, users.name AS reporter_name, 
               incidents.location, incidents.date, incidents.time, incidents.status, incidents.remarks
        FROM incidents
        LEFT JOIN users ON incidents.reported_by = users.user_id
        WHERE 1=1 $role_condition
        ORDER BY incidents.incident_id DESC
    ";
} else {
    // Search query
    $sql = "
        SELECT incidents.incident_id, incidents.description, users.name AS reporter_name, 
               incidents.location, incidents.date, incidents.time, incidents.status, incidents.remarks
        FROM incidents
        LEFT JOIN users ON incidents.reported_by = users.user_id
        WHERE (
            incidents.location LIKE '%$q%' OR
            incidents.description LIKE '%$q%' OR
            incidents.status LIKE '%$q%'
        )
        $role_condition
        ORDER BY incidents.incident_id DESC
    ";
}

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $count = 1;

    while ($row = mysqli_fetch_assoc($result)) {

        // same variables used in the dashboard
        $incidentId = htmlspecialchars($row['incident_id']);
        $description = htmlspecialchars($row['description']);
        $reporter = htmlspecialchars($row['reporter_name']);
        $location = htmlspecialchars($row['location']);
        $date = date("M d, Y", strtotime($row['date']));
        $time = date("g:i A", strtotime($row['time']));
        $status = htmlspecialchars($row['status']);
        $remarks = htmlspecialchars($row['remarks']);

        // Badge colors 
        if ($status == 'Resolved') $badgeClass = "bg-success";
        elseif ($status == 'Ongoing') $badgeClass = "bg-warning";
        else $badgeClass = "bg-danger";

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
        <td colspan='9' class='text-center'>No results found.</td>
    </tr>";
}
