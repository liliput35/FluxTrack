<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="./assets/css/style.css">

</head>
<body>
    <div class="row">
        <?php include('./includes/navbar.php') ?>

        <!-- SANTI GIAN TABLE -->
        <div class="col-sm-10 px-5">
            <h2 class="mb-4">Incident Reports</h2>
                <table class="table">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col">No</th>
                        <th scope="col">Report ID</th>
                        <th scope="col">Reporter Name</th>
                        <th scope="col">Incident Type</th>
                        <th scope="col">Location</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><th scope="row">1</th><td>IR-2021</td><td>Maria Santos</td><td>Equipment Failure</td><td>Main Stage</td><td>Oct 8, 2025</td><td>5:30 PM</td><td>Resolved</td><td>Sound system reset successfully</td></tr>
                    <tr><th scope="row">2</th><td>IR-2022</td><td>John Cruz</td><td>Medical Emergency</td><td>Gate 2</td><td>Oct 8, 2025</td><td>6:10 PM</td><td>Ongoing</td><td>First aid team on standby</td></tr>
                    <tr><th scope="row">3</th><td>IR-2023</td><td>Liza Tan</td><td>Lost Item</td><td>Food Court</td><td>Oct 8, 2025</td><td>6:45 PM</td><td>Resolved</td><td>Item found and returned</td></tr>
                    <tr><th scope="row">4</th><td>IR-2024</td><td>Carlo Dela Cruz</td><td>Crowd Disturbance</td><td>Main Hall</td><td>Oct 8, 2025</td><td>7:05 PM</td><td>Pending</td><td>Security investigating</td></tr>
                    <tr><th scope="row">5</th><td>IR-2025</td><td>Ana Mendoza</td><td>Slip and Fall</td><td>Restroom Area</td><td>Oct 8, 2025</td><td>7:25 PM</td><td>Resolved</td><td>First aid administered</td></tr>
                </tbody>
                </table>
        </div>
    </div>
        
</body>


<?php include('./includes/footer.php') ?>