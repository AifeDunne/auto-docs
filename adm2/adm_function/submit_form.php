<?php
if (!empty($_GET['colCount'])) {
if (!empty($_POST['ftitle'])) {
include_once $_SERVER['DOCUMENT_ROOT'].'/Nimbus/includes/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Nimbus/includes/functions.php';

$jQuery = '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>';
$newTemplate = '
<html>
<head>
'.$jQuery.'
</head>
</body>
<div style="float:none; margin-left:auto; margin-right:auto; width:75vw; height:80vh; margin-top:10vh; background: #000080; color:#FFF;">';
$getColumn = $_GET['colCount'];
$category = $_GET['category'];
$getTitle = $_POST['ftitle'];
$getTitle = str_replace(' ', '_', $getTitle);
$getTitle = strtolower($getTitle);
$addMulti = '';
$addTags = array();
$fTags = array();
$insertTags = '';
$returnCount = 0; $buttonCount = 0; $arrayCount = 0; $tCount = 0; $aCount = 0; $pCount = 0;
$checkArray = array();

function IDType($form, $label) {
global $returnCount, $addTags, $fTags;
$returnCount++;
$fTags[] = array($form, $label);
if (!empty($_POST['taglabel'][$returnCount])) { $addTags[$returnCount] = array(1 => $_POST['taglabel'][$returnCount], 2 => $returnCount); $insertTags = "value=".'"'."'".'.$'."compArray[".$returnCount."]."."'".'"';}
else {$addTags[$returnCount] = array(1 => 0, 2 => 0); $insertTags = '';}
if ($form === "TEXTF") { global $getNumber, $getBreak; $textBox = ''; $boxCount = 0;
	if ($getNumber > 1) { if (!empty($getBreak)) { $insertTags = substr($insertTags,0,-3); } }
	for ($t = 1; $t <= $getNumber; $t++) {
	if ($getNumber > 1) { if (!empty($getBreak)) { $iCount1 = $t - 1; $insertTags.= "[".$iCount1."]."."'".'"'; } else { $insertTags.= ".'".'"';} }
	$textBox.= '<input name="form['.$returnCount.']['.$boxCount.']" id="form['.$returnCount.']['.$boxCount.']" '.$insertTags.' type="text" style="float:left; width:20%; margin-left:1vw;" />'; $boxCount++;
	if ($getNumber > 1) { if (!empty($getBreak)) {$insertTags = substr($insertTags,0,-6);} }
	}
	$newT = '<div id="'.$returnCount.'" style="float:left; width:100%; font-size:1.5vw; margin-top:0.5vw; clear:left;"><span style="float:left;">'.$label.': </span>'.$textBox.'</div>'; 
	$getNumber = '';
}
else if ($form === "DATE") {
	$newT = '<div id="'.$returnCount.'" style="float:left; width:100%; font-size:1.5vw; margin-top:0.5vw; clear:left;"><span style="float:left;">'.$label.': </span><input name="form['.$returnCount.']" id="form['.$returnCount.']" type="text" style="float:left; width:10%; margin-left:1vw;" value="'.date('m-d-Y').'" /></div>';
}
else if ($form === "NUMBER") {
	$newT = '<div id="'.$returnCount.'" style="float:left; width:100%; font-size:1.5vw; margin-top:0.5vw; clear:left;"><span style="float:left;">'.$label.': </span><input name="form['.$returnCount.']" id="form['.$returnCount.']" '.$insertTags.' type="text" style="float:left; width:5%; margin-left:1vw;" /></div>'; 
}
else if ($form === "MULTIPLE") {
	global $addMulti;
	$newT = '<div id="'.$returnCount.'" style="float:left; width:100%; font-size:1.5vw; margin-top:0.5vw; clear:left;"><span style="float:left;margin-right: 2vw;">'.$label.': </span>'.$addMulti.'</div>';
	$addMulti = '';
	$returnCount--;}
else if ($form === "QUESTION") {
	global $tArray;
	$fixedCount = $returnCount - 1;
	$addButton = ''; $addScript = ''; $fullScript = ''; $addSelect = '<select name="select'.$returnCount.'" id="select'.$returnCount.'"'." class='button".$returnCount."'".'><option></option>'; $newT = '<div id="'.$returnCount.'" style="float:left; width:100%; font-size:1.5vw; margin-top:0.5vw; clear:left;"><span style="float:left;margin-right: 2vw;">'.$label.': </span><div id="holdButton'.$returnCount.'">';
		foreach ($tArray as $tArr) {
		$tCount++;
		if ($tArr[1] === "radio") {
		$addSelect = '';
		$addButton.= "<label for='".$tArr[0]."' style='float:left;'>".$tArr[0]."</label><input type='radio' name='".$tArr[0]."' class='button".$returnCount."' value='".$tArr[0]."' style='float:left;'>";}
		else if ($tArr[1] === "select") {
		$addButton = '';
		$addSelect.= "<option name='".$tArr[0]."' value='".$tArr[0]."'>".$tArr[0]."</option>";
		}
		$ifButton = '';
		$eachCount = 0;
			foreach ($tArr[2] as $tAr) {
			$bCount = $tAr[2];
			$bCount = intval($bCount);
			$eachCount++;
			$ifButton.= "<div style='float:right; width:100%; clear:right;'><span style='float:left; margin-right:2vw;'>".$tAr[1]."</span>";
			$rButton = ''; $sButton = "<select id='".$tAr[4][$t]."' name='form[".$returnCount."][".$eachCount."]'><option></option>"; $tButton = '';
				for ($t = 1; $t <= $bCount; $t++) {
				if ($tAr[3] === "radio") { $rButton.= "<label for='".$tAr[4][$t]."' style='float:left;'>".$tAr[4][$t]."</label><input type='radio' id='".$tAr[4][$t]."' name='form[".$returnCount."][".$eachCount."]' value='".$tArr[2][$t]."' style='float:left;'>"; $sButton = ''; $tButton = '';}
				else if ($tAr[3] === "select") { $sButton.= "<option name='".$tAr[4][$t]."' value='".$tAr[4][$t]."'>".$tAr[4][$t]."</option>"; $rButton = ''; $tButton = '';}
				else if ($tAr[3] === "text") { $tButton.= "<div style='float:left; width:23%;'><span style='float:left; margin-left:1vw; margin-right:1vw;'>".$tAr[4][$t]."</span><input id='form[".$returnCount."][".$eachCount."]' name='form[".$returnCount."][".$eachCount."]' type='text' style='float:left;' /></div>"; $rButton = ''; $sButton = '';}
				}
			if (!empty($rButton)) { $ifButton.= $rButton; }
			else if (!empty($sButton)) { $ifButton.= $sButton."</select>"; }
			else if (!empty($tButton)) { $ifButton.= $tButton; }
			$ifButton.= "</div>";
			$addScript.= 'if (v2 == "'.$tArr[0].'") {
			$("#holdButton'.$returnCount.'").empty();
			$("#holdButton'.$returnCount.'").append("'.$ifButton.'");
			}';
			$fullScript.='<script>
			$(".button'.$returnCount.'").change(function(){
			var v2 = $(this).val();
			'.$addScript.'
			});
			</script>';
			}
	}
	if (!empty($addButton)) { $newT.= $addButton; }
	else if (!empty($addSelect)) { $newT.= $addSelect."</select>"; }
	$newT.= "</div>".$fullScript."</div>";
	$FullName = ''; $tArray = ''; }
else if ($form === "IF") { global $ifArray, $ifName; $IFScript = ''; $fullIF = ''; $ifReady = '';
$newT = '<div id="'.$returnCount.'" style="float:left;width:100%; font-size:1.5vw; margin-top:0.5vw; clear:left;">';
$ifCount = 0;
foreach ($ifArray as $ifState) {
$ifCount++;
$newT.= "<label for='".$ifName[$ifCount]."' style='float:left;'>".$ifName[$ifCount]."</label><input type='radio' name='".$ifName[$ifCount]."' class='buttonIf".$returnCount."' value='".$ifState."' style='float:left;'>";
if (!empty($ifState)) {
$IFScript.= 'if (if2 == "'.$ifState.'") {
	$("'.$ifState.'").show();
	$("#'.$returnCount.'").hide();
	}';
$ifReady.= '$("'.$ifState.'").hide();'; }
}
$fullIF.='<script>
	$(document).ready(function() {
	'.$ifReady.'
	});
	$(".buttonIf'.$returnCount.'").change(function(){
	var if2 = $(this).val();
	'.$IFScript.'
	});
	</script>';
$newT.= $fullIF."</div>";
}
return $newT;
}

for ($p = 1; $p <= $getColumn; $p++) {
$formType = $_POST['enterform'][$p];
$formLabel = $_POST['elemlabel'][$p];
if ($formType === "TEXTF") { $getNumber = $_POST['getText'][$p][0]; $getBreak = $_POST['getText'][$p][1];}
if (isset($_POST['multi'.$p])) {
$multiArray = $_POST['multi'.$p];
$returnCount++;
foreach ($multiArray as $multi) {
foreach ($multi as $mul) {
if (!in_array($mul, $checkArray)) {
$checkArray[] = $mul;
$addMulti.= '<label for="'.$formLabel.'" style="float:left;">'.$mul.'</label><input type="radio" name="'.$formLabel.'" id="form['.$returnCount.']['.$buttonCount.']" value="'.$mul.'" style="float:left;">';
			}
		}
	$buttonCount++;}
	}
if (!empty($_POST['question'][$p])) {
$allArray = $_POST['question'][$p];
$arrayName = $_POST['questionName'];
$tArray = ''; $gArray = ''; $pArray = '';
	foreach ($allArray as $all) {
	$arrayCount++;
	$fullCount = '';
	$fullCount = $_POST["addQ"][$p][$arrayCount];
		for ($j = 1; $j <= $fullCount; $j++) {
		$aCount++;
		$pName = $_POST['question'.$p][$p][$aCount];
		$pArray[] = array(1 => $pName, 2 => $_POST["getAnswer".$p][$arrayCount][$j], $_POST['selectType'.$p][$arrayCount][$aCount], $_POST['submenu'.$p][$arrayCount][$aCount]); }
	$tArray[] = array($_POST['question'][$p][$arrayCount], $_POST['fType'][$p], $pArray);
	$pArray = '';
	}
$arrayCount = 0; }
if (!empty($_POST['ifMenu'][$p])) {$ifArray = $_POST['ifMenu'][$p]; $ifName = $_POST['multi'.$p][$p]; }
$newTemplate.= IDType($formType, $formLabel); }

$fCount = $returnCount;
if (!empty($addTags)) { $hasTags = 
"include_once ".'$'."_SERVER['DOCUMENT_ROOT'].'/Nimbus/includes/db_connect.php';
include_once ".'$'."_SERVER['DOCUMENT_ROOT'].'/Nimbus/includes/functions.php';
sec_session_start();
".'$'."checkNumber = '".$fCount."';
".'$'."checkNumber = intval(".'$'."checkNumber);
".'$'."checkThis = '';
".'$'."fullArray = array();
".'$'."stopArray = array();
".'$'."appendArray = array();

".'$'."checkArray = ";
$hasTags.= var_export($addTags, true);
$hasTags.= ";
".'$'."retArray = ";
$hasTags.= var_export($fTags, true);
$hasTags.= ";

for (".'$'."k = 1; ".'$'."k <= ".'$'."checkNumber; ".'$'."k++) {
if (".'$'."checkArray[".'$'."k][1] != '0') { ".'$'."checkThis.=".'"'."'".'"'.".".'$'."checkArray[".'$'."k][1].".'"'."',".'"'."; }
".'$'."fullArray[".'$'."k] = ".'$'."checkArray[".'$'."k][1]; }
".'$'."checkThis = substr(".'$'."checkThis,0,-1);

".'$'."uData = ".'"'."SELECT userData, dataName 
		FROM userPref
		WHERE userID = '".'".$_SESSION['."'user_id'"."].".'"'."' AND dataName IN (".'".$checkThis."'.")".'"'.";
if (".'$'."getData = ".'$'."mysqli->prepare(".'$'."uData)) {
	".'$'."getData->execute();
	".'$'."getData->bind_result(".'$'."dataElement, ".'$'."dataID);
	while (".'$'."getData->fetch()) {
	foreach (".'$'."checkArray as ".'$'."checkF) {
	".'$'."findKey = array_search(".'$'."dataID, ".'$'."checkF);
	if (".'$'."findKey === 1 && ".'$'."checkF[2] != 0) {
	".'$'."stopArray[".'$'."checkF[2]] = ".'$'."checkF[1];
	".'$'."checkA = ".'$'."checkF[2];
	if (strpos(".'$'."dataElement, ' ') !== false) {
	".'$'."compArray[".'$'."checkA] = explode(".'" "'.", ".'$'."dataElement);} 
	else { ".'$'."compArray[".'$'."checkA] = ".'$'."dataElement; }
				}
			}
		}
	".'$'."getData->close();
	for (".'$'."j = 1; ".'$'."j <= ".'$'."checkNumber; ".'$'."j++) { if (".'$'."stopArray[".'$'."j] !== ".'$'."fullArray[".'$'."j] && ".'$'."fullArray[".'$'."j] !== 0) { ".'$'."appendArray[] = ".'$'."fullArray[".'$'."j]; } }
	}
	
	if (".'$'."arraysOnly === true) {
	global ".'$'."retArray, ".'$'."appendArray;
	return;
	}
	if (isset(".'$'."_GET['detailsOnly'])) {
	".'$'."JQueryA = '';
	".'$'."JQueryB = '';
	foreach (".'$'."retArray as ".'$'."retArr) {
	".'$'."JQueryA.= ".'$'."retArr[0].',';
	".'$'."JQueryB.= ".'$'."retArr[1].',';
	}
	".'$'."JQueryA = substr(".'$'."JQueryA,0,-1);
	".'$'."JQueryB = substr(".'$'."JQueryB,0,-1);
	".'$'."arrayNum = ".'$'."checkNumber - 1;
	".'$'."JQueryC = ".'$'."arrayNum.'|'.".'$'."JQueryA.'|'.".'$'."JQueryB;
	echo ".'$'."JQueryC;
	} else {";
 } else { $hasTags = "'$'.'dataArray = ".'""'."';"; }
$addButton = 'method="POST" action="page_func/formInterpreter.php?formID='.$getTitle.'"';
$fTemplate = '<form id="submitfinal" name="submitfinal" '.$addButton.'>'.$newTemplate.'<button id="postfinal" name="postfinal" type="submit" form="submitfinal" style="float:left;margin-top:1vw;margin-left:1vw;height:2.5vw;width:9vw;clear:left;">Submit Form</button>'."</form></div></body></html>";

$writeFile = "<?php
".$hasTags." 
"."$"."compileForm = '".$fTemplate."'; 
echo "."$"."compileForm;
}
?>";

$presetDirectory = $_SERVER['DOCUMENT_ROOT'].'/Nimbus/presets/forms/';
$fullFile = $presetDirectory.$getTitle.".php";
if ($fp=fopen($fullFile,'w')) {
if (fwrite($fp, $writeFile)) {
fclose($fp);
$getCategory = "SELECT contains, groupfiles FROM presetCat WHERE groupID = '".$category."'";
$findCategory = $mysqli->query($getCategory);
$thisCategory = $findCategory->fetch_array();
$itemCount = $thisCategory['contains'];
$itemCount = intval($itemCount);
if ($itemCount != 0) {
$groupFiles = $thisCategory['groupfiles'];
$groupFiles = $groupFiles.",".$getTitle.".php";
} else { $groupFiles = $getTitle.".php"; }
$newCount = $itemCount + 1;
$updateField = "UPDATE presetCat SET contains = ".$newCount.", groupfiles = '".$groupFiles."' WHERE groupID = '".$category."'";
if ($updateQuery = $mysqli->query($updateField)) { header('Location: /Nimbus/adm/add_style.php'); }
	}
}
} else { echo "Form Requires a Name"; }
} else { echo "colCount is empty"; }
?>