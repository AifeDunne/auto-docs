<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/Nimbus/includes/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Nimbus/includes/functions.php';
sec_session_start();
$checkNumber = '4';
$checkNumber = intval($checkNumber);
$checkThis = '';
$fullArray = array();
$stopArray = array();
$appendArray = array();
$checkArray = array (
  1 => 
  array (
    1 => 'FULLNAME',
    2 => 1,
  ),
  2 => 
  array (
    1 => 'SPOUSENAME',
    2 => 2,
  ),
  3 => 
  array (
    1 => 'MARRIAGEDATE',
    2 => 3,
  ),
  4 => 
  array (
    1 => 'INCOME',
    2 => 4,
  ),
);

$retArray = array (
  0 => 
  array (
    0 => 'TEXTF',
    1 => 'Spouse 1',
  ),
  1 => 
  array (
    0 => 'TEXTF',
    1 => 'Spouse 2',
  ),
  2 => 
  array (
    0 => 'TEXTF',
    1 => 'Date of Marriage',
  ),
  3 => 
  array (
    0 => 'NUMBER',
    1 => 'Ghost Income',
  ),
);

for ($k = 1; $k <= $checkNumber; $k++) {
if ($checkArray[$k][1] != '0') { $checkThis.="'".$checkArray[$k][1]."',"; }
$fullArray[$k] = $checkArray[$k][1]; }
$checkThis = substr($checkThis,0,-1);

$uData = "SELECT userData, dataName 
		FROM userPref
		WHERE userID = '".$_SESSION['user_id']."' AND dataName IN (".$checkThis.")";
if ($getData = $mysqli->prepare($uData)) {
	$getData->execute();
	$getData->bind_result($dataElement, $dataID);
	while ($getData->fetch()) {
	foreach ($checkArray as $checkF) {
	$findKey = array_search($dataID, $checkF);
	if ($findKey === 1 && $checkF[2] != 0) {
	$stopArray[$checkF[2]] = $checkF[1];
	$checkA = $checkF[2];
	if (strpos($dataElement, ' ') !== false) {
	$compArray[$checkA] = explode(" ", $dataElement);} 
	else { $compArray[$checkA] = $dataElement; }
				}
			}
		}
	$getData->close();
	for ($j = 1; $j <= $checkNumber; $j++) { if ($stopArray[$j] !== $fullArray[$j] && $fullArray[$j] !== 0) { $appendArray[] = $fullArray[$j]; } }
	}
	
	if ($arraysOnly === true) {
	global $retArray, $appendArray;
	return;
	}
	if ($detailsOnly === true) {
	$JQueryA = '';
	$JQueryB = '';
	foreach ($retArray as $retArr) {
	$JQueryA.= $retArr[0].',';
	$JQueryB.= $retArr[1].',';
	}
	$JQueryA = substr($JQueryA,0,-1);
	$JQueryB = substr($JQueryB,0,-1);
	$arrayNum = $checkNumber - 1;
	$JQueryC = $arrayNum."|".$JQueryA."|".$JQueryB;
	echo $JQueryC;
	} else {
$compileForm = '<form id="submitfinal" name="submitfinal" method="POST" action="page_func/formInterpreter.php?formID=ghost_marriage">
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
</body>
<div style="float:none; margin-left:auto; margin-right:auto; width:75vw; height:80vh; margin-top:10vh; background: #000080; color:#FFF;"><div id="1" style="float:left; width:100%; font-size:1.5vw; margin-top:0.5vw; clear:left;"><span style="float:left;">Spouse 1: </span><input name="form[1][0]" id="form[1][0]" value="'.$compArray[1][0].'" type="text" style="float:left; width:20%; margin-left:1vw;" /><input name="form[1][1]" id="form[1][1]" value="'.$compArray[1][1].'" type="text" style="float:left; width:20%; margin-left:1vw;" /><input name="form[1][2]" id="form[1][2]" value="'.$compArray[1][2].'" type="text" style="float:left; width:20%; margin-left:1vw;" /></div><div id="2" style="float:left; width:100%; font-size:1.5vw; margin-top:0.5vw; clear:left;"><span style="float:left;">Spouse 2: </span><input name="form[2][0]" id="form[2][0]" value="'.$compArray[2][0].'" type="text" style="float:left; width:20%; margin-left:1vw;" /><input name="form[2][1]" id="form[2][1]" value="'.$compArray[2][1].'" type="text" style="float:left; width:20%; margin-left:1vw;" /><input name="form[2][2]" id="form[2][2]" value="'.$compArray[2][2].'" type="text" style="float:left; width:20%; margin-left:1vw;" /></div><div id="3" style="float:left; width:100%; font-size:1.5vw; margin-top:0.5vw; clear:left;"><span style="float:left;">Date of Marriage: </span><input name="form[3][0]" id="form[3][0]" value="'.$compArray[3].'" type="text" style="float:left; width:20%; margin-left:1vw;" /></div><div id="4" style="float:left; width:100%; font-size:1.5vw; margin-top:0.5vw; clear:left;"><span style="float:left;">Ghost Income: </span><input name="form[4]" id="form[4]" value="'.$compArray[4].'" type="text" style="float:left; width:5%; margin-left:1vw;" /></div><button id="postfinal" name="postfinal" type="submit" form="submitfinal" style="float:left;margin-top:1vw;margin-left:1vw;height:2.5vw;width:9vw;clear:left;">Submit Form</button></form></div></body></html>'; 
echo $compileForm;
}
?>