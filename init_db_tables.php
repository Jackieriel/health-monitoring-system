<?php
require_once('include/config.php');
require_once('include/db.php');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully<br><br>";


$sql_users = 'CREATE TABLE IF NOT EXISTS users( ' .
    'id INT NOT NULL AUTO_INCREMENT, ' .
    'username VARCHAR(20) NULL, ' .
    'email  VARCHAR(50) NOT NULL, ' .
    'password   VARCHAR(50) NOT NULL, ' .
    'role VARCHAR(50) DEFAULT "patient", ' .
    'join_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ' .
    'primary key ( id ))';



$sql_patients = 'CREATE TABLE IF NOT EXISTS patients( ' .
    'id INT NOT NULL AUTO_INCREMENT, ' .
    'surname VARCHAR(20) NOT NULL, ' .
    'other_names VARCHAR(100) NULL, ' .
    'gender VARCHAR(10) NOT NULL, ' .
    'date_of_birth VARCHAR(10) NOT NULL, ' .
    'height VARCHAR(10) NULL, ' .
    'weight VARCHAR(10) NULL, ' .
    'phone  VARCHAR(50) NULL, ' .
    'address  VARCHAR(50) NULL, ' .
    'doctor  VARCHAR(50) NULL, ' .
    'user_id  VARCHAR(50) NULL, ' .
    'created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ' .
    'primary key ( id ))';

$sql_patient_test = 'CREATE TABLE IF NOT EXISTS patient_test( ' .
    'id INT NOT NULL AUTO_INCREMENT, ' .
    'patient_id  INT NOT NULL, ' .
    'hba1c FLOAT DEFAULT 0, ' .
    'fbs FLOAT DEFAULT 0, ' .
    'gtt FLOAT DEFAULT 0, ' .
    'ug FLOAT DEFAULT 0, ' .
    'keton FLOAT DEFAULT 0, ' .
    'chol FLOAT DEFAULT 0, ' .
    'created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ' .
    'primary key ( id ))';

$sql_patient_problems = 'CREATE TABLE IF NOT EXISTS patient_problems( ' .
    'id INT NOT NULL AUTO_INCREMENT, ' .
    'patient_id  INT NOT NULL, ' .
    'heart VARCHAR(50)  NULL, ' .
    'kidney VARCHAR(50)  NULL, ' .
    'blood_pressure VARCHAR(50)  NULL, ' .
    'surgery VARCHAR(50)  NULL, ' .
    'created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ' .
    'primary key ( id ))';

$sql_glycemic_indexs  = 'CREATE TABLE IF NOT EXISTS glycemic_indexs( ' .
    'id INT NOT NULL AUTO_INCREMENT, ' .
    'food  VARCHAR(50) NULL, ' .
    'gi FLOAT DEFAULT 0, ' .
    'serve FLOAT DEFAULT 0, ' .
    'carbohydrate VARCHAR(50) NULL, ' .
    'gl VARCHAR(50) NULL, ' .
    'created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ' .
    'primary key ( id ))';

$sql_doctors  = 'CREATE TABLE IF NOT EXISTS doctors( ' .
    'id INT NOT NULL AUTO_INCREMENT, ' .
    'surname  VARCHAR(50) NULL, ' .
    'other_name  VARCHAR(50) NULL, ' .
    'phone  VARCHAR(50) NULL, ' .
    'address VARCHAR(50) NULL, ' .
    'user_id INT NOT NULL, ' .
    'created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ' .
    'primary key ( id ))';

$sql_patient_logs  = 'CREATE TABLE IF NOT EXISTS patient_logs( ' .
    'id INT NOT NULL AUTO_INCREMENT, ' .
    'blood_pressure  FLOAT NULL, ' .
    'blood_glucose  FLOAT NULL, ' .
    'heart_rate  FLOAT NULL, ' .
    'patient_id INT NOT NULL, ' .
    'created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ' .
    'primary key ( id ))';



$sql_queries = array($sql_users, $sql_patients, $sql_patient_test, $sql_patient_problems, $sql_glycemic_indexs, $sql_doctors, $sql_patient_logs);
$db_select = mysqli_select_db($conn, $db_name);


if($db_select){
    for ($i=0; $i < count($sql_queries); $i++) { 
        $result = mysqli_query( $conn, $sql_queries[$i]);

        if (!$result) {
            die("<p style='color:red;'>Could not create table: $sql_queries[$i]<b><br>" . mysqli_error($conn) . "</b><br></p>");
        }else{
            echo "migration successful : $sql_queries[$i]<br><br>";
        }
    }
    
}

mysqli_close($conn);
