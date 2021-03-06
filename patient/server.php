<?php
require_once '../include/db.php';
@session_start();
// connect to database
$db = $conn;

function sendSms()
{
    $message = urlencode("Emergency, A patient need immediate attention");
    $senderid = urlencode('HMSFDM');
    $to = '08131327382';
    $token = 'V4O83zUYVHaGJwJ5cvjal1wdAB4ZAX4tsMrd12kZGGULhsxhYeqtW8zQefPQlohFb8MD84OeHmHyFD4gJO7tnTyDH7SIlvALpug0';
    $routing = 3;
    $type = 0;
    $baseurl = 'https://smartsmssolutions.com/api/json.php?';
    $sendsms = $baseurl.'message='.$message.'&to='.$to.'&sender='.$senderid.'&type='.$type.'&routing='.$routing.'&token='.$token;

    $response = file_get_contents($sendsms);

    echo $response;
}


// Monitor vitals
if ( isset( $_POST['form_type'] ) && $_POST['form_type'] === 'monitor' ) {
//    var_dump($_POST);
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

        if($blood_pressure > 120 && $blood_glucose >200 &&  $heart_rate <=50 ){
            $remark = "Emergency! Need Immediate Doctor\'s Attention";
            sendSms();
        }elseif($blood_pressure <= 125  && $blood_glucose <=70 && $heart_rate >100 ){
            $remark = "Emergency! Need Immediate Doctor\'s Attention";
        }elseif($blood_pressure  >=135  && $blood_glucose <=90 && $heart_rate >100 ){
            $remark = "Use 15gr carbohyrate, Carbohyrate is high, protein is high, Stop Doing anything for atleast 15 minutes";
        }elseif($blood_pressure  <=120  && $blood_glucose >200 && $heart_rate <50 ){
            $remark = "Carbohyrate, protein and sodium is low, Fiber is high, Stop Doing anything for atleast 15 minutes";
        }elseif($blood_pressure  <=120  && $blood_glucose <=200 && $heart_rate <=100 ){
            $remark = "Take a walk for 15 minutes";
        }else{
            $remark = "Health Condition Normal";
        }

        $query = "INSERT INTO patient_logs (blood_pressure, blood_glucose, heart_rate,remark, patient_id)
                    VALUES('$blood_pressure', '$blood_glucose', '$heart_rate' , '$remark','$patient_id')";
        mysqli_query( $db, $query );

        $_SESSION['remark'] = $remark;


        // $message = urlencode("Emergency");
        // $senderid = urlencode('HMSFDM');
        // $to = '08131327382';
        // $token = 'V4O83zUYVHaGJwJ5cvjal1wdAB4ZAX4tsMrd12kZGGULhsxhYeqtW8zQefPQlohFb8MD84OeHmHyFD4gJO7tnTyDH7SIlvALpug0';
        // $routing = 3;
        // $type = 0;
        // $baseurl = 'https://smartsmssolutions.com/api/json.php?';
        // $sendsms = $baseurl.'message='.$message.'&to='.$to.'&sender='.$senderid.'&type='.$type.'&routing='.$routing.'&token='.$token;

        // $response = file_get_contents($sendsms);

        // echo $response;

        header( 'Location: index.php' );

    }


    mysqli_close( $conn );
}

function viewPatientProfile(){
    @session_start();

    global $conn;

    $sql = "SELECT * FROM users WHERE `id`=" .$_SESSION['auth_id'];
    $query = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($query)) {
        $user = $row;
    }

    $sql = "SELECT * FROM patients WHERE `user_id`=" .$user['id'];
    $query = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($query)) {
        $patient = $row;
    }

    $row = $patient;
    $image = $row['image'];
    $_SESSION['auth_phone'] = $row['phone'];

    echo "<img src='$image' >";
    echo "          <p>".$row["surname"]. ' '.$row["other_names"]."</p>".
                    " <p>"." Gender : ".$row["gender"]."</p>".
                    " <p>"."Date Of Birthday : ".$row["date_of_birth"]."</p>".
                    " <p>"."Phone Number : ".$row["phone"]."</p>".
                    " <p>"."Height : ".$row["height"]."</p>".
                    " <p>"."Weight : ".$row["weight"]."</p>".
                    " <p>"."Address : ".$row["address"]."</p>".
                    " <p>"."Doctor : ".$row["doctor"]."</p>";
}



?>