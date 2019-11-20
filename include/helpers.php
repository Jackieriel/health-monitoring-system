<?php 
require_once('config.php');


$errors   = array(); 


//Return to login if session is not set
function sessionNotSet()
{
	if (!isset($_SESSION['user_id'])) {
        // print $_GET['Message'];
        header( 'location: index.php' );
    }
}

//Print Username if the user is login
function printUsername()
{
	if ( isset( $_SESSION['user_id'] ) ) {
		// print $_GET['Message'];
		echo $_SESSION['username'];
	} 
}

// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	