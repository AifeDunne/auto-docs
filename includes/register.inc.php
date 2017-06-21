<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";
if (isset($_POST['username'], $_POST['email'], $_POST['realname'], $_POST['company'], $_POST['p'], $_POST['cardnum'], $_POST['cardname'], $_POST['expdate'], $_POST['cardaddress'], $_POST['cardsec'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
	$realname = filter_input(INPUT_POST, 'realname', FILTER_SANITIZE_STRING);
	$company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
	$cardnumber = filter_input(INPUT_POST, 'cardnum', FILTER_SANITIZE_STRING);
    $cardname = filter_input(INPUT_POST, 'cardname', FILTER_SANITIZE_STRING);
    $cardexp = filter_input(INPUT_POST, 'expdate', FILTER_SANITIZE_STRING);
    $cardaddress = filter_input(INPUT_POST, 'cardaddress', FILTER_SANITIZE_STRING);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $error_msg .= '<p class="error">The email address you entered is not valid</p>'; }
	$cardsecurity = filter_input(INPUT_POST, 'cardsec', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) { $error_msg .= '<p class="error">Invalid password configuration.</p>'; }
    $prep_stmt = "SELECT userID FROM clients WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
                        $stmt->close();
        }
                $stmt->close();
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt->close();
    }
 
    $prep_stmt = "SELECT userID FROM clients WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
                if ($stmt->num_rows == 1) {
                        $error_msg .= '<p class="error">A user with this username already exists</p>';
                        $stmt->close();
                }
                $stmt->close();
        } else {
                $error_msg .= '<p class="error">Database error line 55</p>';
                $stmt->close();
        }
 
    if (empty($error_msg)) {
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
        $password = hash('sha512', $password . $random_salt);
		$insert_stmt = "INSERT INTO clients VALUES (NULL, '".$email."', '".$username."', '".$password."', '".$random_salt."', 0, 1)";
        $insertMembers = $mysqli->query($insert_stmt);
			$grabID = "SELECT userID FROM clients WHERE email = '".$email."'";
			$parseID = $mysqli->query($grabID);
			$getID = $parseID->fetch_array();
			$thisID = $getID['userID'];
		$addDetails = "INSERT INTO customerDetails VALUES ('".$thisID."', '".$realname."', '".$company."', '".$cardnumber."', '".$cardname."', '".$cardexp."', '".$cardaddress."', '".$cardsecurity."')";
        $enterDetails = $mysqli->query($addDetails);
			$clientUpdate = "UPDATE clients SET clientInfo = '".$thisID."' WHERE userID = ".$thisID;
			if ($insertID = $mysqli->query($clientUpdate)) { header('Location: /Nimbus/'); }
			}
		}