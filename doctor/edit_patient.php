<!-- <?php
include 'helper.php';
?> -->
<?php 
session_start();
if (empty($_SESSION['doctor']) OR empty($_SESSION['role'])) {
	header("Location: ../index.php");
}


unset($_SESSION['edit_patient']);
unset($_SESSION['edit_patient_test']);
unset($_SESSION['edit_patient_problems']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Health Monitoring System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../styles/hms.css">
    <link rel="stylesheet" href="../bootstrap/fontawesome.css">
</head>
<body>
    <div class="container register">
    <marquee behavior="" direction="left" class="white">Welcome to Health Monitoring System</marquee>
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="../images/medical.png" alt=""/>

            <h3>FBHMS</h3>
            <p>Edit Patient Edit!</p>
        </div>
        <div class="col-md-9 register-right">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="dashboard.php" aria-selected="true">Main Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="../logout.php" role="tab" aria-controls="profile" aria-selected="false">Logout</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                 
                <div class="group-menu primary text-center">
                    <p class="text-center "><?php patientdetails($_GET['id']);?></p>
                        <a href="edit_patient_info.php" class="margin-right"><i class="fa fa-user-edit fa-4x"></i><br>Edit Patient Info</a>
                        
                        <a href="edit_medical_test.php" class="margin-right"><i class="fa fa-user-edit fa-4x text-center"></i><br>Edit Patient Medical Test</a>

                        <a href="edit_patient_problem.php" class="margin-right"><i class="fa fa-user-edit fa-4x text-center"></i><br>Edit Patient Problem</a>
                </div>
                                       
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php
    include_once "../include/footer.html";
?>
        
    <script src="bootstrap/bootstrap.min.js"></script>

</body>
</html>
