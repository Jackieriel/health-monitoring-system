<?php
include '../include/db.php';

function doctordetails()
{
	global $conn;
	@session_start();
	$role = $_SESSION['role'];
	$username = $_SESSION['patient'];
	$sql = "SELECT * FROM users WHERE `username`='$username' AND `type`='$role'";
	$query = mysqli_query($conn, $sql);
	while ($row =mysqli_fetch_array($query)) {
        echo "Welcome, <i>".$row['username']." ".
        $row['username']."</i> (<a href='../logout.php'>Logout</a>)";
	}
}

function patientdetails($id)
{
	global $conn;
	@session_start();

	$role = 'patient';
	$sql = "SELECT * FROM patients WHERE `id`='$id'";
	$query = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($query);
	if(!$count){
		unset($_SESSION['edit_patient']);
	}else{
		while ($row = mysqli_fetch_array($query)) {
			$_SESSION['edit_patient'] = $row;
		}
	}

}

function getEditedPatientId()
{
	@session_start();
	return $_SESSION['edit_patient']['id'];
}

function getPatientMedicalRecords(){
	global $conn;
	@session_start();

	$id = getEditedPatientId();

	$sql = "SELECT * FROM patient_test WHERE `patient_id`='$id'";
	$query = mysqli_query($conn, $sql);

	$count = mysqli_num_rows($query);

	if(!$count){
		echo 'No record found';
		unset($_SESSION['edit_patient_test']);
		return;
	}else{
		while ($row = mysqli_fetch_array($query)) {
			$_SESSION['edit_patient_test'] = $row;
		}
	}

}

function getPatientProblemsRecords(){
	global $conn;
	@session_start();

	$id = getEditedPatientId();

	$sql = "SELECT * FROM patient_problems WHERE `patient_id`='$id'";
	$query = mysqli_query($conn, $sql);

	$count = mysqli_num_rows($query);

	if(!$count){
		echo 'No record found';
		unset($_SESSION['edit_patient_problems']);
		return;
	}else{
		while ($row = mysqli_fetch_array($query)) {
			$_SESSION['edit_patient_problems'] = $row;
		}
	}

}

?>
