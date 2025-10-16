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
    <div class="layout">
        <?php include('./includes/navbar.php') ?>
        <?php include('./includes/mobile-navbar.php') ?>

        <!-- SANTI GIAN TABLE -->
        <!-- CIOCON edit for STYLES -->

        <div class="main-content">
            <?php include('./includes/mobile-header.php') ?>
            
            <div class="main-content-container">
                <p class="page-info"> <img src="./assets/images/blue-home-icon.png" alt=""><span>Home  /  Dashboard</span></p>
                
                <div class="dashboard-cards">
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

<script>
    document.getElementById('toggleEditMode').addEventListener('click', function () {
    const table = document.querySelector('.incident-table');
    table.classList.toggle('edit-mode');

    if (table.classList.contains('edit-mode')) {
        document.querySelectorAll('.incident-table tbody tr').forEach(row => {
        const rowId = row.getAttribute('data-id');
        const editCell = row.querySelector('.edit-cell');

        // Only add if not already injected
        if (!editCell.querySelector('a')) {
            const link = document.createElement('a');
            link.href = `edit-incident.php`;
            link.innerHTML = '<img src="./assets/images/edit-icon.png"/>'; // or your icon
            link.style.textDecoration = 'none';
            editCell.appendChild(link);
        }
        });
    }
    });
</script>

<?php include('./includes/footer.php') ?>