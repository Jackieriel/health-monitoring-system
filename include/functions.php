<?php
include 'db.php';


// Login Users

function login() {
    require( 'include/db.php' );
    //require_once 'db.php';
    $username = mysqli_real_escape_string( $conn, $_POST['username'] );
    $password = mysqli_real_escape_string( $conn, $_POST['password'] );
    $password = md5( $password );
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $query = mysqli_query( $conn, $sql );

    $row = mysqli_num_rows( $query );
    if ( $row ) {

        if ( $row == 0 ) {
            echo "<b style='font-size:12px;color:red;'>Wrong Username/Password Combination</b>";
        }elseif ( $row == 1 ) {
            $fetch = mysqli_fetch_array($query);
            $role = $fetch['role'];
            $name = $fetch['username'];
            $id = $fetch['id'];
            if ( $role == 'admin' ) {
                @session_start();
                $_SESSION['role'] = $role;
                $_SESSION['admin'] = $name;
                $_SESSION['auth_id'] = $id;
                header( 'Location: admin/' );
            } elseif ( $role == 'doctor' ) {
                @session_start();
                $_SESSION['role'] = $role;
                $_SESSION['doctor'] = $name;
                $_SESSION['auth_id'] = $id;
                header( 'Location: doctor/' );
            } elseif ( $role == 'patient' ) {
                @session_start();
                $_SESSION['role'] = $role;
                $_SESSION['reception'] = $name;
                $_SESSION['auth_id'] = $id;
                header( 'Location: patient/' );
            } else {
                echo "<b style='font-size:12px;color:red;'>Wrong Username/Password Combination</b>";
            }
        } else {
            echo "<b style='font-size:12px;color:red;'>Wrong Username/Password Combination</b>";
        }
    } else {
        echo "<b style='font-size:12px;color:red;'>Wrong Username/Password Combination</b>";
    }
}

// logout Users
function logout()
{
	@session_start();
	session_destroy();
	header("Location: index.php");
}

// Register Doctor

function addDoctor() {

    global $conn;
    // receive all input values from the form
    $username = mysqli_real_escape_string( $conn, $_POST['username'] );
    $email = mysqli_real_escape_string( $conn, $_POST['email'] );
    $password_1 = mysqli_real_escape_string( $conn, $_POST['password_1'] );
    $password_2 = mysqli_real_escape_string( $conn, $_POST['password_2'] );
    $role = mysqli_real_escape_string( $conn, $_POST['role'] );
    $surname = mysqli_real_escape_string( $conn, $_POST['surname'] );
    $other_names = mysqli_real_escape_string( $conn, $_POST['other_names'] );
    $phone = mysqli_real_escape_string( $conn, $_POST['phone'] );
    $address = mysqli_real_escape_string( $conn, $_POST['address'] );

    // create user account for Doctor
    $password = md5( $password_1 );

    require_once 'config.php';

    $sql = "INSERT INTO users (username, email, password, role) VALUES('$username', '$email', '$password', 'doctor')";
    $query = mysqli_query( $conn, $sql );

    $user_id = mysqli_insert_id( $conn );
    // echo var_dump( $user_id );

    if ( $user_id > 0 ) {
        // create Doctor profile
        $query2 = "INSERT INTO doctors (surname, other_name, phone, address, user_id)
          VALUES('$surname', '$other_names', '$phone', '$address', $user_id)";
        mysqli_query( $conn, $query2 );
    }

    if ( !empty( $query ) ) {
        echo "<br><b style='color:#008080;font-size:14px;font-family:Arial;align:center;'>Doctor Succesfully Registered</b><br><br>";
    } else {
        echo mysqli_error();
    }
}

?>

