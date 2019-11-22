<?php 
session_start();
if (empty($_SESSION['admin']) OR empty($_SESSION['role'])) {
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
                        <h3 class="register-heading primary">Doctor's Registration Form</h3>

                        <form method="post" action="index.php" class="row register-form">
                            <div class="col-12">
                            </div>
                            <input type="hidden" name="role" value="doctor">
                            <input type="hidden" name="form_type" value="doctor">
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
                            <!-- <div class="mb-3">
                                <hr>
                            </div>
                            <hr class="mb-3 red"> -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="surname" class="form-control" required
                                        placeholder="Last name">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="other_names" class="form-control" required
                                        placeholder="Other names">
                                </div>

                            </div>
                            <!-- Right Side -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="tel" name="phone" class="form-control" minlength="11" maxlength="14"
                                        required placeholder="Phone number">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="address" class="form-control" required
                                        placeholder="Home Address">
                                </div>
                            </div>
                            <div class="col-12 mt-3 mb-3">
                                <input type="submit" name = "btn" class="btn btn-primary btn-block btn-md" />
                            </div>
                        </form>
                        <div class='text-center no-top-margin'>
                            <?php 
                                extract($_POST);
                                if (isset($btn) && !empty($username) 
                                && !empty($email) 
                                &&!empty($password_1)
                                &&!empty($password_2)
                                &&!empty($surname)
                                &&!empty($other_names)
                                &&!empty($phone) 
                                && !empty($address)) {
                                    require "../include/functions.php";
                                    addDoctor();
                            }
                            ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    </script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    </script>
</body>

</html>