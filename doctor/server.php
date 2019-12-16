<?php
require_once '../include/db.php';

// require_once 'session.php';
// variable declaration
// $username = '';
$db = 'jackieriel';
// $email = '';
$errors = array();
// $_SESSION['success'] = '';
@session_start();

//Save patient Id into session


$patient_id = '';

// connect to database
$db = $conn;

// REGISTER PATIENT
if ( isset( $_POST['form_type'] ) && $_POST['form_type'] === 'patient' ) {

    // receive all input values from the form
    $username = mysqli_real_escape_string( $db, $_POST['username'] );
    $email = mysqli_real_escape_string( $db, $_POST['email'] );
    $password_1 = mysqli_real_escape_string( $db, $_POST['password_1'] );
    $password_2 = mysqli_real_escape_string( $db, $_POST['password_2'] );
    $role = mysqli_real_escape_string( $db, $_POST['role'] );
    $surname = mysqli_real_escape_string( $db, $_POST['surname'] );
    $other_names = mysqli_real_escape_string( $db, $_POST['other_names'] );
    $date_of_birth = mysqli_real_escape_string( $db, $_POST['date_of_birth'] );
    $height = mysqli_real_escape_string( $db, $_POST['height'] );
    $weight = mysqli_real_escape_string( $db, $_POST['weight'] );
    $gender = mysqli_real_escape_string( $db, $_POST['gender'] );
    $phone = mysqli_real_escape_string( $db, $_POST['phone'] );
    $address = mysqli_real_escape_string( $db, $_POST['address'] );
    $doctor_name = mysqli_real_escape_string( $db, $_POST['doctor_name'] );


    //    Image validation
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        array_push( $errors, "File is not an image.");
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        array_push( $errors, "Sorry, file already exists.");
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 50000000) {
        array_push( $errors, "Sorry, your file is too large.");
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        array_push( $errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        $uploadOk = 0;
    }



    // form validation: ensure that the form is correctly filled
    if ( empty( $username ) ) {
        array_push( $errors, 'Username is required' );
    }
    if ( empty( $email ) ) {
        array_push( $errors, 'Email is required' );
    }
    if ( empty( $password_1 ) ) {
        array_push( $errors, 'Password is required' );
    }
    if ( empty( $surname ) ) {
        array_push( $errors, 'Surname is required' );
    }
    if ( empty( $date_of_birth ) ) {
        array_push( $errors, 'Date of Birth is required' );
    }
    if ( empty( $height ) ) {
        array_push( $errors, 'Height of patient is required' );
    }
    if ( empty( $gender ) ) {
        array_push( $errors, 'Gender is required' );
    }
    if ( empty( $weight ) ) {
        array_push( $errors, 'Body weight is required or average' );
    }
    if ( empty( $phone ) ) {
        array_push( $errors, 'Phone is required ' );
    }
    if ( empty( $address ) ) {
        array_push( $errors, 'Address of patient is required ' );
    }
    if ( empty( $address ) ) {
        array_push( $errors, 'Address of patient is required ' );
    }

    if ( $password_1 != $password_2 ) {
        array_push( $errors, 'The two passwords do not match' );
    }


    // register user if there are no errors in the form
    if ( count( $errors ) < 1 ) {
        if (move_uploaded_file($target_file, $_FILES["image"]["tmp_name"])) {
            echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

        // create user account for patient
        $password = md5( $password_1 );
        //encrypt the password before saving in the database
        $query = "INSERT INTO users (username, email, password, role)
					  VALUES('$username', '$email', '$password', 'patient')";
        mysqli_query( $conn, $query );
        $user_id = mysqli_insert_id( $conn );

        if ( $user_id > 0 ) {
            // create patient profile
            $query2 = "INSERT INTO patients (surname, other_names, gender, date_of_birth, height, weight, phone, address, doctor, user_id, image)
              VALUES('$surname', '$other_names', '$gender', '$date_of_birth', '$height', '$weight', '$phone', '$address', '$doctor_name', $user_id, '$target_file')";
            mysqli_query( $conn, $query2 );
            $patient_id = mysqli_insert_id( $conn );

            $_SESSION['patient_id'] = $patient_id;
        }

        header( 'location: medical_test.php' );
    } else {
        for ( $i = 0; $i < count( $errors );
        $i++ ) {
            echo $errors[$i] . '<br>';
        }
    }

    mysqli_close( $conn );
}

//Update Patient
if ( isset( $_POST['form_type'] ) && $_POST['form_type'] === 'edit_patient' ) {

    // receive all input values from the form
    $surname = mysqli_real_escape_string( $db, $_POST['surname'] );
    $other_names = mysqli_real_escape_string( $db, $_POST['other_names'] );
    $date_of_birth = mysqli_real_escape_string( $db, $_POST['date_of_birth'] );
    $height = mysqli_real_escape_string( $db, $_POST['height'] );
    $weight = mysqli_real_escape_string( $db, $_POST['weight'] );
    $gender = mysqli_real_escape_string( $db, $_POST['gender'] );
    $phone = mysqli_real_escape_string( $db, $_POST['phone'] );
    $address = mysqli_real_escape_string( $db, $_POST['address'] );
    $doctor_name = mysqli_real_escape_string( $db, $_POST['doctor_name'] );

    // form validation: ensure that the form is correctly filled
    if ( empty( $surname ) ) {
        array_push( $errors, 'Surname is required' );
    }
    if ( empty( $date_of_birth ) ) {
        array_push( $errors, 'Date of Birth is required' );
    }
    if ( empty( $height ) ) {
        array_push( $errors, 'Height of patient is required' );
    }
    if ( empty( $gender ) ) {
        array_push( $errors, 'Gender is required' );
    }
    if ( empty( $weight ) ) {
        array_push( $errors, 'Body weight is required or average' );
    }
    if ( empty( $phone ) ) {
        array_push( $errors, 'Phone is required ' );
    }
    if ( empty( $address ) ) {
        array_push( $errors, 'Address of patient is required ' );
    }
    if ( empty( $doctor_name ) ) {
        array_push( $errors, 'Address of patient is required ' );
    }

    // update user if there are no errors in the form
    if ( count( $errors ) < 1 ) {
        // update patient profile
        $query = "UPDATE patients SET surname = '$surname', other_names = '$other_names', gender = '$gender',
                    date_of_birth = '$date_of_birth', height = '$height', weight = '$weight', phone ='$phone', 
                    address = '$address', doctor = '$doctor_name' WHERE id = {$_SESSION['edit_patient']['id']}";

        if(mysqli_query( $conn, $query )){
            header( "location: edit_patient.php?id={$_SESSION['edit_patient']['id']}");
        }

    } else {
        for ( $i = 0; $i < count( $errors );
              $i++ ) {
            echo $errors[$i] . '<br>';
        }
    }

    mysqli_close( $conn );
}

// Add medical Test
if ( isset( $_POST['form_type'] ) && $_POST['form_type'] === 'medical_test' ) {
    // receive all input values from the form
    $patient_id = $_SESSION['patient_id'];
    $hba1c = mysqli_real_escape_string( $db, $_POST['hba1c'] );
    $fbs = mysqli_real_escape_string( $db, $_POST['fbs'] );
    $gtt = mysqli_real_escape_string( $db, $_POST['gtt'] );
    $ug = mysqli_real_escape_string( $db, $_POST['ug'] );
    $keton = mysqli_real_escape_string( $db, $_POST['keton'] );
    $chol = mysqli_real_escape_string( $db, $_POST['chol'] );


    // form validation: ensure that the form is correctly filled
    if ( empty( $hba1c ) ) {
        array_push( $errors, 'HBA1C value  is required' );
    }
    if ( empty( $fbs ) ) {
        array_push( $errors, 'FBS value is required' );
    }
    if ( empty( $gtt ) ) {
        array_push( $errors, 'GTT value is required' );
    }
    if ( empty( $ug ) ) {
        array_push( $errors, 'UG value is required' );
    }
    if ( empty( $keton ) ) {
        array_push( $errors, 'Keton value is required' );
    }
    if ( empty( $chol ) ) {
        array_push( $errors, 'Chol value is required' );
    }

    // register user if there are no errors in the form
    if ( count( $errors ) == 0 ) {
        $query = "INSERT INTO patient_test (patient_id, hba1c, fbs, gtt,ug,keton,chol)
                  VALUES(' $patient_id', '$hba1c', '$fbs', '$gtt' ,'$ug', '$keton' , '$chol')";
       $mysqli_query = mysqli_query( $db, $query );
       
    //    var_dump(mysqli_insert_id($conn));

        //Store last session patient ID
//        $_SESSION['patient_id'] = mysqli_insert_id( $conn );
       

        // $_SESSION['username'] = $username;
        // $_SESSION['success'] = 'You are now logged in';
        header( 'location: patient_problem.php' );
    }
    mysqli_close( $conn );
}

// Add medical Problems
if ( isset( $_POST['form_type'] ) && $_POST['form_type'] === 'patient_problem' ) {
    // receive all input values from the form
    $patient_id = $_SESSION['patient_id'];
    $heart = mysqli_real_escape_string( $db, $_POST['heart'] );
    $kidney = mysqli_real_escape_string( $db, $_POST['kidney'] );
    $blood_pressure = mysqli_real_escape_string( $db, $_POST['blood_pressure'] );
    $surgery = mysqli_real_escape_string( $db, $_POST['surgery'] );

    // form validation: ensure that the form is correctly filled
    if ( empty( $heart ) ) {
        array_push( $errors, 'Heart Problem record is required' );
    }
    if ( empty( $kidney ) ) {
        array_push( $errors, 'Kidney problem record is required' );
    }
    if ( empty( $blood_pressure ) ) {
        array_push( $errors, 'High blood pressure recordnis required' );
    }
    if ( empty( $surgery ) ) {
        array_push( $errors, 'Surrgery record is required' );
    }

    // register user if there are no errors in the form
    if ( count( $errors ) == 0 ) {
        $query = "INSERT INTO patient_problems (patient_id, heart, kidney, blood_pressure, surgery)
                  VALUES('$patient_id', '$heart', '$kidney', '$blood_pressure' ,'$surgery')";
        mysqli_query( $db, $query );

        // $_SESSION['username'] = $username;
        // $_SESSION['success'] = 'You are now logged in';

        $message = 'Registration Successful';
        echo "<script type='text/javascript'>alert('$message');</script>";

        header( 'location: index.php' );
    }
    mysqli_close( $conn );
}

//Update Medical Test
if ( isset( $_POST['form_type'] ) && $_POST['form_type'] === 'edit_medical_test' ) {
    // receive all input values from the form

    $patient_id = $_SESSION['edit_patient']['id'];
    $hba1c = mysqli_real_escape_string( $db, $_POST['hba1c'] );
    $fbs = mysqli_real_escape_string( $db, $_POST['fbs'] );
    $gtt = mysqli_real_escape_string( $db, $_POST['gtt'] );
    $ug = mysqli_real_escape_string( $db, $_POST['ug'] );
    $keton = mysqli_real_escape_string( $db, $_POST['keton'] );
    $chol = mysqli_real_escape_string( $db, $_POST['chol'] );


    // form validation: ensure that the form is correctly filled
    if ( empty( $hba1c ) ) {
        array_push( $errors, 'HBA1C value  is required' );
    }
    if ( empty( $fbs ) ) {
        array_push( $errors, 'FBS value is required' );
    }
    if ( empty( $gtt ) ) {
        array_push( $errors, 'GTT value is required' );
    }
    if ( empty( $ug ) ) {
        array_push( $errors, 'UG value is required' );
    }
    if ( empty( $keton ) ) {
        array_push( $errors, 'Keton value is required' );
    }
    if ( empty( $chol ) ) {
        array_push( $errors, 'Chol value is required' );
    }

    // register user if there are no errors in the form
    if ( count( $errors ) == 0 ) {
        $query = "UPDATE patient_test SET hba1c = '$hba1c', fbs = '$fbs', gtt = '$gtt',ug = '$ug',keton = '$keton',chol = '$chol' WHERE patient_id = $patient_id";

        if(mysqli_query( $db, $query )){
            header( "location: edit_patient.php?id={$patient_id}");
        }
    }

    mysqli_close( $conn );
}

//Update Medical Problems
if ( isset( $_POST['form_type'] ) && $_POST['form_type'] === 'edit_patient_problem' ) {
    // receive all input values from the form
    $patient_id = $_SESSION['edit_patient']['id'];
    $heart = mysqli_real_escape_string( $db, $_POST['heart'] );
    $kidney = mysqli_real_escape_string( $db, $_POST['kidney'] );
    $blood_pressure = mysqli_real_escape_string( $db, $_POST['blood_pressure'] );
    $surgery = mysqli_real_escape_string( $db, $_POST['surgery'] );

    // form validation: ensure that the form is correctly filled
    if ( empty( $heart ) ) {
        array_push( $errors, 'Heart Problem record is required' );
    }
    if ( empty( $kidney ) ) {
        array_push( $errors, 'Kidney problem record is required' );
    }
    if ( empty( $blood_pressure ) ) {
        array_push( $errors, 'High blood pressure recordnis required' );
    }
    if ( empty( $surgery ) ) {
        array_push( $errors, 'Surrgery record is required' );
    }

    // register user if there are no errors in the form
    if ( count( $errors ) == 0 ) {
        $query = "UPDATE patient_problems SET heart = '$heart', kidney = '$kidney', blood_pressure = '$blood_pressure', surgery = '$surgery' WHERE patient_id = $patient_id";

        if(mysqli_query( $db, $query )){
            header( "location: edit_patient.php?id={$patient_id}");
        }
    }
    mysqli_close( $conn );
}

