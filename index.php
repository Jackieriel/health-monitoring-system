<!-- <?php include_once 'include/session.php'?> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FBIHMS</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>

<style>
body{
    color:red;
}
</style>
<body>
    <?php
    include_once 'include/header.html';
    ?>
    <div class="grid">
        <div class="grid-col first-section text-white">
            <img src="images/medical.png" alt="" />
            <!-- <h1 class="text-center">Test</h1>
          <h1>Test</h1> -->
        </div>
        <div class="grid-col white">
            <div class="form-grid">
                <h3 class="primary text-center transform-upper">Login</h3>
                <form action="index.php" method="POST" class="my-form">
                    <label for="">Username</label><br>
                    <input type="text" name="username" required autocomplete="off" placeholder="Username"><br>

                    <label for="">Password</Title></label><br>
                    <input type="password" name="password" required autocomplete="off" placeholder="Password"><br>

                    <button class="btn btn-primary btn-block mt-4" type="submit" name="login_user">Login</button>
                </form>
                <?php
                    extract($_POST);
                    if (isset($login_user) && !empty($username) && !empty($password)) {
                        require 'include/functions.php';
                        login();
                    } 
                    
		 ?>
            </div>
        </div>
    </div>




    <?php
    include_once 'include/footer.html';
    ?>

    <script src="script/hms.js"></script>
</body>

</html>