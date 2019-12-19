<?php
include 'db.php';
require_once '../include/config.php';


function viewpatient() {
    require 'db.php';
    $sql = "SELECT users.id,patients.* From users INNER JOIN patients ON users.id = patients.user_id WHERE role = 'patient'";
    $query = mysqli_query( $conn, $sql );


    if ( mysqli_num_rows( $query ) > 0 ) {
        // echo "<table  border='1' style='width:100%'>
        echo "
        <thead>
            <tr>
                <th >Patient ID</th>
                <th >Surname</th>
                <th >Other Names</th>
                <th >Gender</th>
                <th >Date Of Birth</th>
                <th >Phone</th>
                <th >Height</th>
                <th >Weight</th>
                <th >Address</th>
                <th >Doctor</th>
                <th >Date Registered</th>
                <th >Action</th>
            </tr>
        </thead>";
        // output data of each row
        while( $row = mysqli_fetch_assoc( $query ) ) {
            echo "<tbody>".
                    "<tr>".
                            " <td>".$row["id"]."</td>".
                            " <td>".$row["surname"]."</td>".
                            " <td>".$row["other_names"]."</td>".
                            " <td>".$row["gender"]."</td>".
                            " <td>".$row["date_of_birth"]."</td>".
                            " <td>".$row["phone"]."</td>".
                            " <td>".$row["height"]."</td>".
                            " <td>".$row["weight"]."</td>".
                            " <td>".$row["address"]."</td>".
                            " <td>".$row["doctor"]."</td>".
                            "  <td>".$row["created_at"]."</td>".
                            "  <td> <a href='edit_patient.php?id=" .$row["id"]. "'>Edit</a></td>".
                    "</tr>".
                 "</tbody>" ;
        }
        // echo "</table>";
    } else {
        echo 'No Patient Record found';
    }

    mysqli_close( $conn );

}

// View Patient medical Test

function viewPatientTest(){
    require 'db.php';
    $sql = "SELECT patients.id,patients.surname,patients.other_names,patient_test.* From patients INNER JOIN patient_test ON patients.id = patient_test.patient_id";
    $query = mysqli_query( $conn, $sql );


    if ( mysqli_num_rows( $query ) > 0 ) {
        // echo "<table  border='1' style='width:100%'>
        echo "
        <thead>
            <tr>
                <th >Patient ID</th>
                <th >Patient Name</th>
                <th >HBA1C</th>
                <th >FBS</th>
                <th >GTT</th>
                <th >UG</th>
                <th >KETON</th>
                <th >CHOL</th>
                <th >Date Registered</th>
            </tr>
        </thead>";
        // output data of each row
        while( $row = mysqli_fetch_assoc( $query ) ) {
            echo "<tbody>".
                    "<tr>".
                            " <td>".$row["patient_id"]."</td>".
                            " <td>".$row["surname"]." ".$row["other_names"]."</td>".
                            " <td>".$row["hba1c"]."</td>".
                            " <td>".$row["fbs"]."</td>".
                            " <td>".$row["gtt"]."</td>".
                            " <td>".$row["ug"]."</td>".
                            " <td>".$row["keton"]."</td>".
                            " <td>".$row["chol"]."</td>".
                            " <td>".$row["created_at"]."</td>".
                    "</tr>".
                 "</tbody>" ;
        }
        // echo "</table>";
    } else {
        echo 'No Patient Record found';
    }

    mysqli_close( $conn );    

}

function viewPatientproblem(){
    require 'db.php';
    $sql = "SELECT patients.id,patients.surname,patients.other_names,patient_problems.* From patients INNER JOIN patient_problems ON patients.id = patient_problems.patient_id";
    $query = mysqli_query( $conn, $sql );


    if ( mysqli_num_rows( $query ) > 0 ) {
        // echo "<table  border='1' style='width:100%'>
        echo "
        <thead>
            <tr>
                <th >Patient ID</th>
                <th >Patient Name</th>
                <th >Hear Problem</th>
                <th >Kidney Problem</th>
                <th >Blood Pressure</th>
                <th >Surgury</th>
                <th >Date Registered</th>
            </tr>
        </thead>";
        // output data of each row
        while( $row = mysqli_fetch_assoc( $query ) ) {
            echo "<tbody>".
                    "<tr>".
                            " <td>".$row["patient_id"]."</td>".
                            " <td>".$row["surname"]." ".$row["other_names"]."</td>".
                            " <td>".$row["heart"]."</td>".
                            " <td>".$row["kidney"]."</td>".
                            " <td>".$row["blood_pressure"]."</td>".
                            " <td>".$row["surgery"]."</td>".
                            "  <td>".$row["created_at"]."</td>".
                    "</tr>".
                 "</tbody>" ;
        }
        // echo "</table>";
    } else {
        echo 'No Patient Record found';
    }

    mysqli_close( $conn );    

}

function updatepatient()
{
	$id = $_GET['id'];
    $email = mysqli_real_escape_string( $db, $_POST['email'] );
    $surname = mysqli_real_escape_string( $db, $_POST['surname'] );
    $other_names = mysqli_real_escape_string( $db, $_POST['other_names'] );
    $date_of_birth = mysqli_real_escape_string( $db, $_POST['date_of_birth'] );
    $height = mysqli_real_escape_string( $db, $_POST['height'] );
    $weight = mysqli_real_escape_string( $db, $_POST['weight'] );
    $gender = mysqli_real_escape_string( $db, $_POST['gender'] );
    $phone = mysqli_real_escape_string( $db, $_POST['phone'] );
    $address = mysqli_real_escape_string( $db, $_POST['address'] );
    $doctor_name = mysqli_real_escape_string( $db, $_POST['doctor_name'] );

	require_once "db.php";

	$sql = "UPDATE patients SET `email`='$email',`surname`='$surname',`other_names`='$other_names',`date_of_birth`='$date_of_birth',`height`='$height',`weight`='$weight',`gender`='$gender',`address`='$address',`phone`='$phone',`doctor_name`='$doctor_name' WHERE `id`='$id'";
	//$sql = "INSERT INTO hospital.` VALUES ('','$fname','$sname','$email','$address','$phone','$gender','$bloodgroup','$birthyear')";
	$query = mysqli_query($conn,$sql);
	if (!empty($query)) {
		echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Patient is Succesifully Updated</b><br><br>";
	}
	else{
		echo mysqli_error();
	}
}

function viewPatientrealtime() {
    require 'db.php';
    // $sql = "SELECT patients.id,patients.surname,patients.other_names,patient_logs.* From patients INNER JOIN patient_logs ON patients.id = patient_logs.patient_id";
    // $query = mysqli_query( $conn, $sql );


    // if ( mysqli_num_rows( $query ) > 0 ) {

        $sql = "SELECT patients.id,patients.surname,patients.other_names,patient_logs.* From patients INNER JOIN patient_logs ON patients.id = patient_logs.patient_id";
        $query = mysqli_query( $conn, $sql );
    
    
        if ( mysqli_num_rows( $query ) > 0 ) {
        // echo "<table  border='1' style='width:100%'>
        echo "
        <thead>
            <tr>
                <th >Patient ID</th>
                <th >Surname</th>
                <th >Other Names</th>
                <th >Blood Pressure</th>
                <th >Blood Glucose</th>
                <th >Heart Rate</th>
                <th >Remark</th>
                <th >Time Stamp</th>
            </tr>
        </thead>";
        // output data of each row
        while( $row = mysqli_fetch_assoc( $query ) ) {
            echo "<tbody>".
                    "<tr>".
                            " <td>".$row["id"]."</td>".
                            " <td>".$row["surname"]."</td>".
                            " <td>".$row["other_names"]."</td>".
                            " <td>".$row["blood_pressure"]."</td>".
                            " <td>".$row["blood_glucose"]."</td>".
                            " <td>".$row["heart_rate"]."</td>".
                            " <td>".$row["remark"]."</td>".
                            "  <td>".$row["created_at"]."</td>".
                    "</tr>".
                 "</tbody>" ;
        }
        // echo "</table>";
    } else {
        echo 'No Patient Record found';
    }

    mysqli_close( $conn );

}

?>



