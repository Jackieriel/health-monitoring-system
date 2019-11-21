<?php
include 'db.php';
require_once '../include/config.php';

function addpatient() {
    global $conn;
    // receive all input values from the form
    $username = mysqli_real_escape_string( $conn, $_POST['username'] );
    $email = mysqli_real_escape_string( $conn, $_POST['email'] );
    $password_1 = mysqli_real_escape_string( $conn, $_POST['password_1'] );
    $password_2 = mysqli_real_escape_string( $conn, $_POST['password_2'] );
    $role = mysqli_real_escape_string( $conn, $_POST['role'] );
    $surname = mysqli_real_escape_string( $conn, $_POST['surname'] );
    $other_names = mysqli_real_escape_string( $conn, $_POST['other_names'] );
    $date_of_birth = mysqli_real_escape_string( $conn, $_POST['date_of_birth'] );
    $height = mysqli_real_escape_string( $conn, $_POST['height'] );
    $weight = mysqli_real_escape_string( $conn, $_POST['weight'] );
    $gender = mysqli_real_escape_string( $conn, $_POST['gender'] );
    $phone = mysqli_real_escape_string( $conn, $_POST['phone'] );
    $address = mysqli_real_escape_string( $conn, $_POST['address'] );
    $doctor_name = mysqli_real_escape_string( $conn, $_POST['doctor_name'] );

    // create user account for patient
    $password = md5( $password_1 );

    $sql = "INSERT INTO users (username, email, password, role) VALUES('$username', '$email', '$password', 'patient')";
    $query = mysqli_query( $conn, $sql );

    $user_id = mysqli_insert_id( $conn );
    // echo var_dump( $user_id );

    if ( $user_id > 0 ) {
        // create patient profile
        $query2 = "INSERT INTO patients (surname, other_names, gender, date_of_birth, height, weight, phone, address, doctor, user_id)
          VALUES('$surname', '$other_names', '$gender', '$date_of_birth', '$height', '$weight', '$phone', '$address', '$doctor_name', $user_id)";
        mysqli_query( $conn, $query2 );

        $_SESSION['patient_id'] = mysqli_insert_id( $conn );
        //save the value in the $_SESSION

        if ( !empty( $query ) ) {
            header( 'location:test.html' );
            // echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;'>Patient personal information Succesfully Added</b><br><br>";
        } else {
            echo mysqli_error();
        }

    }

}

function viewpatient() {
    // $id = $_GET['id'];
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
                    "</tr>".
                 "</tbody>" ;
        }
        // echo "</table>";
    } else {
        echo '0 results';
    }

    mysqli_close( $conn );

}
?>