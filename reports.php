<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="./assets/css/style.css">

</head>
<body>
    <div class="layout">
        <?php include('./includes/navbar.php') ?>
        <?php include('./includes/mobile-navbar.php') ?>

        <!-- SANTI GIAN TABLE -->
        <!-- CIOCON edit for STYLES -->

        <div class="main-content">
            <?php include('./includes/mobile-header.php') ?>
            
            <div class="main-content-container">
                <p class="page-info"> <img src="./assets/images/blue-report-icon.png" alt=""><span>Reports  /  Incidents</span></p>

                <h2 class="page-heading">Incident Reports</h2>
                

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
                        <th scope="col">Reporter Name</th>
                        <th scope="col">Incident Type</th>
                        <th scope="col">Location</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Remarks</th>
                        <th class="edit-col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row" data-label="No">1</th>
                        <td data-label="Incident Type">Equipment Failure</td>
                        <td data-label="Reporter Name">Maria Santos</td>
                        <td data-label="Date">Oct 8, 2025</td>
                        <td data-label="Time">5:30 PM</td>
                        <td data-label="Location">Main Stage</td>
                        <td data-label="Status">Resolved</td>
                        <td data-label="Remarks">Sound system reset successfully</td> 
                        <td class="edit-cell"></td>   
                    </tr>
                    <tr>
                        <th scope="row" data-label="No">2</th>
                        <td data-label="Incident Type">Medical Emergency</td>
                        <td data-label="Reporter Name">John Cruz</td>
                        <td data-label="Date">Oct 8, 2025</td>
                        <td data-label="Time">6:10 PM</td>
                        <td data-label="Location">Gate 2</td>
                        <td data-label="Status">Ongoing</td>
                        <td data-label="Remarks">First aid team on standby</td> 
                        <td class="edit-cell"></td> 
                    </tr>
                    <tr>
                        <th scope="row" data-label="No">3</th>
                        <td data-label="Incident Type">Lost Item</td>
                        <td data-label="Reporter Name">Liza Tan</td>
                        <td data-label="Date">Oct 8, 2025</td>
                        <td data-label="Time">6:45 PM</td>
                        <td data-label="Location">Food Court</td>
                        <td data-label="Status">Resolved</td>
                        <td data-label="Remarks">Item found and returned</td>   
                        <td class="edit-cell"></td> 
                    </tr>
                    <tr>
                        <th scope="row" data-label="No">4</th>
                        <td data-label="Incident Type">Crowd Disturbance</td>
                        <td data-label="Reporter Name">Carlo Dela Cruz</td>
                        <td data-label="Date">Oct 8, 2025</td>
                        <td data-label="Time">7:05 PM</td>
                        <td data-label="Location">Main Hall</td>
                        <td data-label="Status">Pending</td>
                        <td data-label="Remarks">Security investigating</td>  
                        <td class="edit-cell"></td>   
                    </tr>
                    <tr>
                        <th scope="row" data-label="No">5</th>
                        <td data-label="Incident Type">Slip and Fall</td>
                        <td data-label="Reporter Name">Ana Mendoza</td>
                        <td data-label="Date">Oct 8, 2025</td>
                        <td data-label="Time">7:25 PM</td>
                        <td data-label="Location">Restroom Area</td>
                        <td data-label="Status">Resolved</td>
                        <td data-label="Remarks">First aid administered</td> 
                        <td class="edit-cell"></td>    
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        
    </div>
        
</body>

<script src="./assets/js/main.js"></script>


<?php include('./includes/footer.php') ?>