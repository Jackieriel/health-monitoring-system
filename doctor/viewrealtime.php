<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/viewpatient.css">
    <link rel="stylesheet" href="../styles/table.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap/fontawesome.css">
    <title>FBIHMS</title>
</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">FBIHMS</a>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="../logout.php">Sign out</a>
            </li>
        </ul>
    </nav>
    <main role="main" class="col">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="dashboard">Welcome</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          <ul class="nav" >
                            <li class="active"><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm"> Home</span></a></li>
                            <li><a href="../doctor/addpatient.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm"> Add Patient</span></a></li>
                            <li><a href="viewpatients.php"><i class="fa fa-database" aria-hidden="true"></i><span class="hidden-xs hidden-sm"> Patient Personal Info</span></a></li>
                            <li><a href="viewmedicaltest.php"><i class="fa fa-database" aria-hidden="true"></i><span class="hidden-xs hidden-sm"> Medical Test Record</span></a></li>
                            <li><a href="viewpatientProblem.php"><i class="fa fa-database" aria-hidden="true"></i><span class="hidden-xs hidden-sm"> Medical Problem</span></a></li>
                            <li><a href="viewrealtime.php"><i class="fa fa-database" aria-hidden="true"></i><span class="hidden-xs hidden-sm"> Vital Record</span></a></li>
                            <li><a href="viewpatients.php"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm"> Edit Records</span></a></li>
                    </ul>
          </div>
        </div>
      </div>

    <div class="container-fluid">
                <div class="table-responsive">
                <p>Real Time Record</p>
                    <table class="table table-sm">
                            <?php 
                                require '../include/doctor.php';
                                viewPatientrealtime();
                            ?>
                    </table>
                </div>
            </main>
        <!-- </div> -->
    </div>





</body>

</html>