<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/Nimbus/includes/db_connect.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/Nimbus/includes/functions.php';

if (!empty($_GET['formID'])) {
$formID = $_GET['formID'];
$formID = intval($formID);
if (isset($_POST['getform'])) { $identifyForm = $_POST['getform']; }
if (isset($_GET['getform'])) { $identifyForm = $_GET['getform']; }
$identifyForm = intval($identifyForm);

$retrieve = "SELECT groupfiles FROM presetCat WHERE categoryID = ".$formID;
$getFiles = $mysqli->query($retrieve);
$results = $getFiles->fetch_array();
$rawlist = $results['groupfiles'];
$fullArray[] = explode(',', $rawlist);
$locateFile = $fullArray[0][$identifyForm];
if (isset($_POST['getform'])) { include_once 'forms/'.$locateFile; }
if (isset($_GET['getform'])) { global $detailsOnly; $detailsOnly = true; include_once $_SERVER['DOCUMENT_ROOT'].'/Nimbus/presets/forms/'.$locateFile; }
		}
?>