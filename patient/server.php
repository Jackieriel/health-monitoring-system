<?php
require_once '../include/db.php';
@session_start();
// connect to database
$db = $conn;

// Monitor vitals
if ( isset( $_POST['form_type'] ) && $_POST['form_type'] === 'monitor' ) {
    var_dump($_POST);
    // receive all input values from the form
    $patient_id = $_SESSION['auth_id'];
    $blood_pressure = mysqli_real_escape_string( $db, $_POST['blood_pressure'] );
    $blood_glucose = mysqli_real_escape_string( $db, $_POST['blood_glucose'] );
    $heart_rate = mysqli_real_escape_string( $db, $_POST['heart_rate'] );

    // form validation: ensure that the form is correctly filled
    if ( empty( $blood_pressure ) ) {
        array_push( $errors, 'Blood Pressure is required' );
    }
    if ( empty( $blood_glucose ) ) {
        array_push( $errors, 'Blood glucose is required' );
    }
    if ( empty( $heart_rate ) ) {
        array_push( $errors, 'heart rate is required' );
    }



    if ( empty( $errors ) ) {

        if($blood_pressure > 120 && $blood_glucose >200 &&  $heart_rate <=100 )
        {
            $remark = "Emergency! Need Immediate Doctor's Attention";
        }elseif($blood_pressure > 120  && $blood_glucose <=70 && $heart_rate >100 )
        {
            $remark = "Emergency! Need Immediate Doctor's Attention";
        }else{
            $remark = "Health Condition Normal";
        }

        $query = "INSERT INTO patient_logs (blood_pressure, blood_glucose, heart_rate,remark, patient_id)
                    VALUES('$blood_pressure', '$blood_glucose', '$heart_rate' , '$remark','$patient_id')";
        mysqli_query( $db, $query );

        $_SESSION['remark'] = $remark;

        header( 'Location: index.php' );

    }


    mysqli_close( $conn );
}



?>