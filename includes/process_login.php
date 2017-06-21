<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start();
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p'];
    if (login($email, $password, $mysqli) == true) {
	$privGroup = array_values(mysqli_fetch_array($mysqli->query("SELECT userLevel FROM clients WHERE email = '".$email."'")))[0];
		if ($privGroup === '2') {
		header('Location: ../Admin.php');
		}
		else if ($privGroup === '1') {
		header('Location: ../Nimbus.php');
		}
    }
} else { echo 'Invalid Request'; }