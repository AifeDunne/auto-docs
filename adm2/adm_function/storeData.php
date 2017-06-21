<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/Nimbus/includes/functions.php';
sec_session_start();

$countColumn = $_POST['colCount'];
$params = $_POST['submitform'];
parse_str($params);
$nQueryA = '';
$nQueryB = '';
$formInfo = array();
$jCount = 0;
for ($p = 1; $p <= $countColumn; $p++) {
if (!empty($enterform[$p]) && !empty($elemlabel[$p])) {
$jCount++;
$formInfo[] = array($enterform[$p], $elemlabel[$p]);
$nQueryA.= $enterform[$p].',';
$nQueryB.= $elemlabel[$p].','; 
	}
}
$nQueryA = substr($nQueryA,0,-1);
$nQueryB = substr($nQueryB,0,-1);
$newNum = $jCount - 1;
$nQueryC = $newNum."|".$nQueryA."|".$nQueryB;
echo $nQueryC;
?>