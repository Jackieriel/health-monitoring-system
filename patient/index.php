<?php //include('../include/patient.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Health Monitoring System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../styles/monitor.css">
    <link rel="stylesheet" href="../bootstrap/fontawesome.css">
    <link rel="stylesheet" href="../styles/hms.css">
</head>

<body>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 login-form-1 bg-white">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active primary" id="home-tab" data-toggle="tab" href="#" role="tab"
                            aria-controls="dashboard.php" aria-selected="true">Welcome To FBHMS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="../logout.php" role="tab"
                            aria-controls="profile" aria-selected="false">Logout</a>
                    </li>
                </ul>
                <form action="server.php" method="post">
                    <h2 class="text-center primary">Monitor Vital Signs</h2>

                    <input type="hidden" name="form_type" value="monitor">

                    <div class="form-group">
                        <input type="number" step='0.01' class="form-control" name=blood_pressure required
                            autocomplete="off" placeholder="Blood Pressure"><br>
                    </div>
                    <div class="form-group">
                        <input type="number" step='0.01' class="form-control" name=blood_glucose required
                            autocomplete="off" placeholder="Blood Glucose"><br>
                    </div>
                    <div class="form-group">
                        <input type="number" step='0.01' class="form-control" name=heart_rate required
                            autocomplete="off" placeholder="Heart Rate"><br>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block btn-md" />
                        <!-- <button type="submit" class="btn btn-primary btn-block">Submit</button> -->
                    </div>
                </form>
            </div>
            <div class="col-md-6 login-form-2">
                <!-- <h2 class="text-white text-center"> Welcome 
                
                </h2> -->

                <div class="profiling text-white">
                    <h4>Personal Profile</h4>
                    <img src="images/Jackieriel1.jpg" alt="profile Pic">
                    <p>Jonah Jackson J</p>
                    <p>Date of birth</p>
                    <p>Gender</p>
                    <p>Height</p>
                    <p>Weight</p>
                </div>

            </div>
        </div>
        
    </div>
    <div>
        <?php
            include_once "../include/footer.html";
        ?>    
    </div>
    

    <script src="bootstrap/bootstrap.min.js"></script>

</body>

</html>