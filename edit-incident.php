<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Incident</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="./assets/css/style.css">

</head>
<body>
    <div class="layout">
        <?php include('./includes/navbar.php') ?>
        <?php include('./includes/mobile-navbar.php') ?>


        <div class="main-content">
            <?php include('./includes/mobile-header.php') ?>
            
            <div class="main-content-container incident-form">

                <p class="page-info"> <img src="./assets/images/blue-account-icon.png" alt=""><span>Edit  /  Incident</span></p>

                <h1>Editing Incident</h1>
                
                <h2>Incident Details</h2>

                <div class="incident-details">

                    <div class="incident-text-inputs">
                        <div class="incident-form-group">
                            <p>Reporter Name</p>
                            <input type="text" value="Juan Cruz">
                        </div>
                        
                        <div class="incident-form-group">
                            <p>Incident Type</p>
                            <input type="text" value="Wet Floor">
                        </div>
    
                        <div class="incident-form-group">
                            <p>Location</p>
                            <input type="text" value="3rd Floor">
                        </div>
    
                        <div class="date-time">
                            <div class="left-date">
                                <p>Date</p>
                                <input type="date" value="2004-11-14">
                            </div>
                            <div class="right-time">
                                <p>Time</p>
                                <input type="time" value="14:30">
                            </div>
                        </div>
                    </div>

                    <p>Status</p>
                    <div class="status-btns">
                        <button>Unresolved</button>
                        <button>Ongoing</button>
                        <button>Resolved</button>
                    </div>

                    <p>Remarks</p>
                    <textarea name="" id="" value="">Floor wetness logged. Hazard mitigation in progress</textarea><br>

                    <button class="submit-btn">Save Report Changes</button>
                </div>
            </div>

        </div>
        
    </div>
        
</body>


<?php include('./includes/footer.php') ?>