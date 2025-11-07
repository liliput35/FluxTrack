<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login-page.php");
    exit;
}

include('./db_connect.php');

if (isset($_POST['delete_incident'])) {
    $incident_id = intval($_POST['incident_id']);

    $sql = "DELETE FROM incidents WHERE incident_id = $incident_id";
    mysqli_query($conn, $sql);

    // Also delete related logs
    mysqli_query($conn, "DELETE FROM incident_status_updates WHERE incident_id = $incident_id");

    header("Location: ../pages/dashboard.php");
    exit;
}
?>
