<?php
session_start();
if (!empty($_SESSION['admin'])&&!empty($_SESSION['role'])) {
	header("Location: admin/");
}
elseif (!empty($_SESSION['doctor'])&&!empty($_SESSION['role'])) {
	header("Location: doctor/index.php");
}
elseif (!empty($_SESSION['patient'])&&!empty($_SESSION['role'])) {
	header("Location: patient/");
}
else
{
	// header("location:index.php");
}
?>
