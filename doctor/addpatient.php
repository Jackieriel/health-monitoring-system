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
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="dashboard.php" role="tab"
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

                        <form method="post" action="addpatient.php" class="row register-form">
                            <div class="col-12">
                            </div>
                            <input type="hidden" name="role" value="patient">
                            <input type="hidden" name="form_type" value="patient">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" required
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_1" required class="form-control" required
                                        placeholder="Password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" required placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_2" class="form-control" required required
                                        placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="mb-3">
                                <hr>
                            </div>
                            <hr class="mb-3 red">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="surname" class="form-control" required
                                        placeholder="Last name">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="other_names" class="form-control" required
                                        placeholder="Other names">
                                </div>
                                <div class="form-group">
                                    <input type="date" name="date_of_birth" class="form-control" required
                                        placeholder="Date of Birth">
                                </div>
                                <div class="form-group">
                                    <input type="number" name="height" class="form-control" required
                                        placeholder="Height">
                                </div>
                                <div class="form-group">
                                    <input type="number" name="weight" class="form-control" required
                                        placeholder="Body Weight">
                                </div>
                            </div>
                            <!-- Right Side -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="gender" required>
                                        <option class="hidden" selected disabled>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="tel" name="phone" class="form-control" minlength="11" maxlength="14"
                                        required placeholder="Phone number">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="address" class="form-control" required
                                        placeholder="Home Address">
                                </div>
                                <div class="form-group margin-none">
                                    <input type="text" name="doctor_name" class="form-control" required
                                        placeholder="Please Enter Doctor's Name"><br>
                                </div>
                                <div class="form-group margin-none">
                                    <input type="file" name="image" onchange="preview_image(event)" >
                                </div>
                            </div>
                            <div class="col-12 mt-3 mb-3">
                                <input type="submit" name="btn" class="btn btn-primary btn-block btn-md" />
                            </div>
                        </form>
                        <div class="text-center no-top-margin">
                        <?php 
                            extract($_POST);
                            if (isset($btn) && 
                            !empty($username) && 
                            !empty($email) &&
                            !empty($password_1)&&
                            !empty($password_2)&&
                            !empty($surname)&&
                            !empty($other_names)&&
                            !empty($date_of_birth) && 
                            !empty($height)&&
                            !empty($weight)&&
                            !empty($gender)&&
                            !empty($phone) && 
                            !empty($address) && 
                            !empty($doctor_name))

                            if ( $password_1 != $password_2 ) {
                                // echo "<b style='color:red;font-size:14px;font-family:Arial;'>Password Does Not Match, Form Not Submitted</b>";
                                echo "<script> alert('Password Does Not Match, Form Not Submitted')</script>";
                            }
                            else
                            {
                                require "../include/doctor.php";
                                addpatient();
                            }
			            ?>
                        </div>
                        
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