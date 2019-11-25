<?php
    require "../include/doctor.php";
include 'helper.php';

?>

<?php 
session_start();
if (empty($_SESSION['doctor']) OR empty($_SESSION['role'])) {
	header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Health Monitoring System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../styles/hms.css">
</head>

<body>
    <div class="container register">
        <marquee behavior="" direction="left" class="white">Welcome to Health Monitoring System</marquee>
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="images/medical.png" alt="" />
                <h3>FBHMS</h3>
                <p>Health Monitoring System For Managing Diabetes Militus</p>
                <!-- <input type="submit" name="" value="Login"/><br/> -->
            </div>

            <div class="col-md-9 register-right">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="index.php" role="tab"
                            aria-controls="home" aria-selected="true">Main Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="../logout.php" role="tab"
                            aria-controls="profile" aria-selected="false">Logout</a>
                    </li>
                </ul>
                <?php getPatientProblemsRecords();?>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading primary">Edit Patient's medical Problems</h3>

                        <form method="post" action="server.php" class="row register-form">
                            <div class="col-12"><?php include('../include/errors.php'); ?>
                            </div>
<!--                            --><?php //if(count($errors) > 0):?>
                            <!-- <input type="hidden" name="role" value="patient"> -->
                            <input type="hidden" name="form_type" value="patient_problem">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="heart" required>
                                        <option class="hidden" disabled>Heart Problem ?</option>
                                        <option <?php if($_SESSION['edit_patient_problems']['heart'] == 'yes'){ echo 'selected';}?> value="yes">Yes</option>
                                        <option <?php if($_SESSION['edit_patient_problems']['heart'] == 'no'){ echo 'selected';}?> value="no">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select class="form-control" name="kidney" required>
                                        <option class="hidden" disabled>kidney Problem ?</option>
                                        <option <?php if($_SESSION['edit_patient_problems']['kidney'] == 'yes'){ echo 'selected';}?> value="yes">Yes</option>
                                        <option <?php if($_SESSION['edit_patient_problems']['kidney'] == 'no'){ echo 'selected';}?> value="no">No</option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="blood_pressure" required>
                                        <option class="hidden" disabled>High Blood Pressure ?</option>
                                        <option <?php if($_SESSION['edit_patient_problems']['blood_pressure'] == 'yes'){ echo 'selected';}?> value="yes">Yes</option>
                                        <option <?php if($_SESSION['edit_patient_problems']['blood_pressure'] == 'no'){ echo 'selected';}?> value="no">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select class="form-control" name="surgery" required>
                                        <option class="hidden" disabled>Surgery Problem ?</option>
                                        <option <?php if($_SESSION['edit_patient_problems']['surgery'] == 'yes'){ echo 'selected';}?> value="yes">Yes</option>
                                        <option <?php if($_SESSION['edit_patient_problems']['surgery'] == 'no'){ echo 'selected';}?> value="no">No</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Right Side -->

                            <div class="col-12 mt-3 mb-3">
                                <input type="submit" value="Update" class="btn btn-primary btn-block btn-md" />
                            </div>
<!--                            --><?php //else: ?>
<!--                                <div class="text-center">-->
<!--                                    <h4 class="primary">No Patient Problem for User</h4>-->
<!--                                </div>-->
<!--                            --><?php //endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once "../include/footer.html";
?>


    <script src="../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>