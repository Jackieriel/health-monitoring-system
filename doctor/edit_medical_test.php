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
                <?php getPatientMedicalRecords();?>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading primary">Edit Patient's medical Test</h3>

                        <form method="post" action="server.php" class="row register-form">
                            <div class="col-12"><?php include('../include/errors.php'); ?>
                            </div>
                            <!-- <input type="hidden" name="role" value="patient"> -->
                            <input type="hidden" name="form_type" value="medical_test">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="number" name="hba1c" class="form-control" required value="<?php echo $_SESSION['edit_patient_test']['hba1c']?>"
                                        placeholder="HBA1C">
                                </div>

                                <div class="form-group">
                                    <input type="number" name="fbs" class="form-control" required value="<?php echo $_SESSION['edit_patient_test']['fbs']?>"
                                        placeholder="FBS (Fasting Blood Suger)">
                                </div>

                                <div class="form-group">
                                    <input type="number" name="gtt" class="form-control" required value="<?php echo $_SESSION['edit_patient_test']['gtt']?>"
                                        placeholder="GTT (Glucose Tolorance Test)">
                                </div>
                            </div>

                            

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="number" name="ug" class="form-control" required value="<?php echo $_SESSION['edit_patient_test']['ug']?>" placeholder="UG">
                                </div>

                                <div class="form-group">
                                    <input type="number" name="keton" class="form-control" required value="<?php echo $_SESSION['edit_patient_test']['keton']?>"
                                        placeholder="Keton (Ketonic Level)">
                                </div>

                                <div class="form-group">
                                    <input type="number" name="chol" class="form-control" required value="<?php echo $_SESSION['edit_patient_test']['chol']?>"
                                        placeholder="(CHOL (Cholesterol Test">
                                </div>
                            </div>

                            <!-- Right Side -->
                            
                            <div class="col-12 mt-3 mb-3">
                                <input type="submit" value="Update" class="btn btn-primary btn-block btn-md" />
                            </div>
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