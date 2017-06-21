<?php
if (isset($_POST['formID'])) {
if (isset($_POST['fullArray'])) {
	$formID = $_POST['formID'];
	$formID = str_replace(' ', '_', $formID);
	$formID = strtolower($formID);
	$fullArray = $_POST['fullArray'];
	$finalArray = array();
	$unpack = explode("+>", $fullArray);
		foreach ($unpack as $cluster) {
		$secondArray = array();
		$unstring = explode("|", $cluster);
		foreach ($unstring as $elements) {
			if (strpos($elements,"+]") != false) {
			$unArray = explode("+]", $elements);
			$secondArray[] = array($unArray[0], $unArray[1]);
			} else { $secondArray[] = $elements; }
			}
			$finalArray[] = $secondArray;
		}
		$fileJSON = json_encode($finalArray);
		$jsonDir = $_SERVER['DOCUMENT_ROOT'].'/Nimbus/presets/forms/format/';
		$completeFile = $jsonDir.$formID.".json";
		if ($jsonWrite=fopen($completeFile,'w')) {
		if (fwrite($jsonWrite, $fileJSON)) { fclose($jsonWrite); }
		}
	}
}
?>