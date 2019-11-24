<?php
require_once '../include/db.php';

// connect to database
$db = $conn;

// Monitor vitals
if ( isset( $_POST['form_type'] ) && $_POST['form_type'] === 'monitor' ) {
    // receive all input values from the form
    // $patient_id = $_SESSION['patient_id'];
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
    //    return 'error';
    }

    function postVital($pressure, $glucose, $heart_rate, $remark, $patient_id = 2) {
        $query = "INSERT INTO patient_logs (blood_pressure, blood_glucose, heart_rate,remark, patient_id)
                    VALUES('$blood_pressure', '$blood_glucose', '$heart_rate' , '$remark','$patient_id')";
            mysqli_query( $db, $query );
        
            // $_SESSION['username'] = $username;
            // $_SESSION['success'] = 'You are now logged in';
            header( 'location: index.php' );
            // return;
    }



    // return var_dump('this is running');

    if($blood_pressure >120 && $blood_glucose >200 &&  $heart_rate <=100 )
    {
        $remark = "Emergency need Immediate Doctor's Attendtion";
        // postVital($blood_pressure, $blood_glucose, $heart_rate, $remark);

        $query = "INSERT INTO patient_logs (blood_pressure, blood_glucose, heart_rate,remark, patient_id)
                    VALUES('$blood_pressure', '$blood_glucose', '$heart_rate' , '$remark','$patient_id')";
            mysqli_query( $db, $query );
        
            // $_SESSION['username'] = $username;
            // $_SESSION['success'] = 'You are now logged in';
            header( 'location: index.php' );
    
    }elseif($blood_pressure >120  && $blood_glucose <=70 && $heart_rate >100 )
    {
        $remark = "Emergency need Immediate Doctor's Attendtion";
        $query = "INSERT INTO patient_logs (blood_pressure, blood_glucose, heart_rate,remark, patient_id)
                    VALUES('$blood_pressure', '$blood_glucose', '$heart_rate' , '$remark','$patient_id')";
            mysqli_query( $db, $query );
        
            // $_SESSION['username'] = $username;
            // $_SESSION['success'] = 'You are now logged in';
            header( 'location: index.php' );
    
    }else{
        $remark = "Health Condition Normal";
    }
   
    
    mysqli_close( $conn );
}



?>