<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Nimbus/dompdf/dompdf_config.inc.php');

if (isset($_GET['formID'])) {
$documentName = $_GET['formID'];
$arraysOnly = true;
include_once $_SERVER['DOCUMENT_ROOT'].'/Nimbus/presets/forms/'.$documentName.".php";
$format = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Nimbus/presets/forms/format/'.$documentName.".json"));
$formatElement = array();
$smallArray = array();
$attachArray = array();
$elementCount = 0; $attachCount = 0; $aCount = 0; $textCount = 0;
$form = '<body style="width: 100%;">';

foreach ($format as $attached) {
$primKey = $attached[0];
if ($primKey === 'ATTACHED') {$attachCount++; $attachArray[] = array($aCount, $attached[2], $attached[3]);}
$aCount++;
}

foreach ($format as $formatItem) {
$smallArray = array();
$keyCount = 0;
$aKey = array_keys($formatItem);
$primaryKey = $formatItem[0];
$keyValue = $formatItem[1];

if ($primaryKey === 'ELEMENT') {
$elementCount++;
foreach($formatItem as $extract1) { if ($keyCount === 0 || $keyCount === 1) {}
else { $smallArray[] = $extract1; } $keyCount++; }
$formatElement[$keyValue] = $smallArray;
	}
if ($primaryKey === 'HEADER') {
$form.= "<div style='position:absolute; left:".$formatItem[3][0]."; top:".$formatItem[3][1]."; font-size:38px;'>".$formatItem[2]."</div>";
	}
if ($primaryKey === 'TEXT') {
$form.= "<div style='position:absolute; left:".$formatItem[3][0]."; top:".$formatItem[3][1]."; font-size:26px;'>";
if ($attachCount === 0) { $form.= $formatItem[2]; }
	else { $textID = "TEXT".$keyValue;
	foreach($attachArray as $aArr) {
	$retKey = '';
	$upperCA = strtoupper($aArr[1]);
	if ($upperCA === $textID) {
	$retKey = $aArr[0];
	$postKey = $format[$retKey][1];
	$idThis2 = is_array($_POST['form'][$postKey]);
	$stringThis2 = '';
	if ($idThis2 === true) { foreach ($_POST['form'][$postKey] as $takeAll) { $stringThis2.= $takeAll." "; } }
	else { $stringThis2.= $_POST['form'][$postKey]; }
	$positionKeyA = $aArr[2][0];
	$positionKeyB = $aArr[2][1];
	$positionKeyB = substr($positionKeyB, 2);
	$positionKeyB = str_replace("Text", "", $positionKeyB);
	$positionKeyB = intval($positionKeyB);
	if ($positionKeyA === "BEFORE") { $positionKeyB = $positionKeyB - 1; }
	if ($positionKeyB < 0) { $form.= "<span>".$stringThis2." ".$formatItem[2]."</span>"; }
	else { $wordCount = 0;
	$textCount++;
	$fullWords = '';
	$allWords = explode(" ", $formatItem[2]);
	foreach($allWords as $words) {
	$fullWords.= $words." ";
	if ($wordCount === $positionKeyB) {$fullWords.= $stringThis2." ";}
	$wordCount++;
							}
	$form.= '<span>'.$fullWords.'</span>';
						}
				}
			}
		}
	}
$form.= "</div>";
	}

for ($e = 1; $e <= $elementCount; $e++) {
$idThis = is_array($_POST['form'][$e]);
if (!empty($_POST['form'][$e])) {
$stringThis = '';
$coord1 = round($formatElement[$e][1][0]);
$coord2 = round($formatElement[$e][1][1]);
$coord2 = $coord2 + 13;
$form.= "<div style='position:absolute; left:".$coord1."; top:".$coord2."; font-size:26px;'>";
if ($idThis === true) { foreach ($_POST['form'][$e] as $takeElem) { $stringThis.= $takeElem." "; } $form.= $stringThis;}
else { $form.= $_POST['form'][$e]; }
$form.= "</div>";
	}
}
$form.= "</body>";
$dompdf = new DOMPDF();
$dompdf->load_html($form);
$dompdf->set_paper('letter');
$dompdf->render();
$dompdf->stream($documentName.".pdf");
}
?>