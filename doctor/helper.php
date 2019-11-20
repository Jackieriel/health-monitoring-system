<?php
include '../include/db.php';

function doctordetails()
{	global $conn;
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


?>
