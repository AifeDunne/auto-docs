<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/Nimbus/includes/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Nimbus/includes/functions.php';

if (isset($_POST['addcat'])) {
	$category = $_POST['addcat'];
	if (isset($_POST['addgroup'])) {
	$group = $_POST['addgroup'];
	$addCategory = "INSERT INTO presetCat VALUES (NULL, '".$category."', '".$group."', 0, '')";
	if($insertCategory = $mysqli->query($addCategory)) { header('Location: /Nimbus/Admin.php');	}
	else { printf ($mysqli->error); }
		} 
	} else { echo "You can not leave the category name blank"; }

?>