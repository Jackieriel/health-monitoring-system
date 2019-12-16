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
                <img src="../images/medical.png" alt="" />
                <h3>FBHMS</h3>
                <p>Health Monitoring System For Managing Diabetes Militus</p>
                <img id="output_image"/>
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
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading primary">Patient's Registration Form</h3>

                        <?php getEditedPatientId();?>
                        
                        <form method="post" action="edit_patient_info.php" class="row register-form">

                            <div class="col-12"><?php include('../include/errors.php'); ?>
                            </div>
                            <input type="hidden" name="form_type" value="edit_patient">
                            <div class="mb-3">
                                <hr>
                            </div>
                            <hr class="mb-3 red">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="surname" value="<?php echo $_SESSION['edit_patient']['surname']; ?>"  class="form-control" required
                                        placeholder="Surname Name">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="other_names" value="<?php echo $_SESSION['edit_patient']['other_names']; ?>"  class="form-control" required
                                        placeholder="Other names">
                                </div>
                                <div class="form-group">
                                    <input type="date" name="date_of_birth" value="<?php echo $_SESSION['edit_patient']['date_of_birth']; ?>"  class="form-control" required
                                        placeholder="Date of Birth">
                                </div>
                                <div class="form-group">
                                    <input type="number" name="height" value="<?php echo $_SESSION['edit_patient']['height']; ?>"  class="form-control" required
                                        placeholder="Height">
                                </div>
                                <div class="form-group">
                                    <input type="number" name="weight" value="<?php echo $_SESSION['edit_patient']['weight']; ?>"  class="form-control" required
                                        placeholder="Body Weight">
                                </div>
                            </div>
                            <!-- Right Side -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="gender" required>
                                        <option class="hidden" selected disabled>Select Gender</option>
                                        <option <?php if($_SESSION['edit_patient']['gender'] == 'male'){ echo 'selected';}?> value="male">Male</option>
                                        <option <?php if($_SESSION['edit_patient']['gender'] == 'female'){ echo 'selected';}?> value="female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="tel" name="phone" value="<?php echo $_SESSION['edit_patient']['phone']; ?>"  class="form-control" minlength="11" maxlength="14"
                                        required placeholder="Phone number">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="address" value="<?php echo $_SESSION['edit_patient']['address']; ?>"  class="form-control" required
                                        placeholder="Home Address">
                                </div>
                                <div class="form-group margin-none">
                                    <input type="text" name="doctor_name" value="<?php echo $_SESSION['edit_patient']['doctor']; ?>"  class="form-control" required
                                        placeholder="Please Enter Doctor's Name"><br>
                                </div>
                                <!-- <div class="form-group margin-none">
                                    <input type="file" name="image" onchange="preview_image(event)" >
                                </div> -->
                            </div>

                            <div class="col-12 mt-3 mb-3">
                                <input type="submit" value="Update" name="btn" class="btn btn-primary btn-block btn-md" />
                            </div>
                        </form>
                        
                        <?php 
                            extract($_POST);
                            // if (isset($btn) && !empty($fname) && !empty($sname) &&!empty($email)&&!empty($phone)&&!empty($address)&&!empty($gender)&&!empty($birthyear) && !empty($bloodgroup)) {
                                // require "../includes/reception.php";
                                updatepatient();
                            // }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once "../include/footer.html";
?>
    <script src="../script/hms.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>