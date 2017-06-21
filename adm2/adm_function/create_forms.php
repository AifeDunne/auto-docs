<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/Nimbus/includes/db_connect.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/Nimbus/includes/functions.php';
	sec_session_start();
?>
	<div id="navBar" style="float:left; width:100%; height:8vh; background: #000080;">
		<div id="Tab1" class="navButton">Build Form</div>
		<div id="Tab2" class="navButton">Create Macro</div>
		<div id="Tab3" class="navButton">Style Format</div>
		<div style="float:right; height:100%; width:17%; margin-right:1%; text-align:center;"><a href="includes/logout.php" style="font-size:2vw; color:#FFF;">Log Out</a></div>
	</div>
	<div id="page1" name="page1" style="position:absolute; top: 11vh; left: 1vw; width: 99%; overflow:hidden;">
	<?php
	if (isset($_POST['formnumber'])) {
	if (isset($_POST['addtocat'])) {
	$addForms = $_POST['formnumber'];
	$addForms = intval($addForms);
	$categoryName = $_POST['addtocat'];
	$formAdd = '<form id="submitform" id="submitform">
	<div style="float:left; clear:both; font-size:2vw; width:38vw; margin-bottom:2.5vw;"><span style="float:left;">Form Title: </span><input name="ftitle" id="ftitle" type="text" style="float:left; width:56%; margin-left:0.5vw; height: 2vw;" /></div>
	<hr style="clear:left; background-color: #d3d3d3; height: 1px; border: 0;"><div id="formContent">';
		for ($f = 1; $f <= $addForms; $f++) {
		$formAdd.= '<div id="'.$f.'" class="formRow" style="float:left; clear:left; width:93%; min-height:8vh; height:auto; padding-top:2vh; border-bottom:1px solid #d3d3d3;"><div style="float:left; width:14%;"><span style="font-size:1.5vw; float:left;color:#000;">'.$f.'.</span><textarea name="elemlabel['.$f.']" id="elemlabel['.$f.']" rows="1" cols="26" placeholder="Question" style="width:78%; float:right; height:2vw;" /></textarea></div>
		<div style="float:left; width:10%; margin-left:0.5vw;"><select id="enterform['.$f.']" name="enterform['.$f.']" class="selectMenu"><option></option><option name="DATE" value="DATE">- DATE</option><option name="TEXTF" value="TEXTF">- TEXT FIELD</option><option name="NUMBER" value="NUMBER">- NUMBER</option><option name="mChoice" value="MULTIPLE">- MULTIPLE CHOICE</option><option name="QUESTION" value="QUESTION">- QUESTIONNAIRE</option><option name="IF" value="IF">- IF STATEMENT</option></select></div><div style="float:right; width:10%;"><textarea name="taglabel['.$f.']" id="taglabel['.$f.']" rows="1" cols="26" placeholder="Element Tag" style="width:100%; float:left; height:2vw;" /></textarea></div></div>';}
		$formAdd.= '</div></form><div id="buttonHolder" style="float:left; clear:left; margin-top:2vh;"><button id="addelements" id="addelements">Add Preset Form</button></div>';
		echo $formAdd;
		} else { echo "Please select a category first"; }
		} else { echo "Please fill out the number of columns"; }
	?>
	<script>
	currentColumnNumber = <?php echo $addForms; ?>;
	currentCategoryName = '<?php echo $categoryName; ?>';
	</script>
</div>
	<div id="page2" name="page2" style="position:absolute; top:8vh; left:0; width:0%; overflow:hidden;">
		<div style="float:left; width:100%; height:100%; margin-top:2vh; margin-bottom: 2vh;">
		<div style="float:left; width:auto; margin-left:5%; height:auto; padding:1%; background: #000080;">
		<div id="styleBox" style="float:left; width:auto; height:100%;"><div id="styleArea" style="float:left; width:595.28px; height:841.89px; margin-right: 1vw; background:#FFF; color:#000;"></div>
		<div id="presetHolder" style="float:right; width:17vw; padding-right:3vw; padding-top:2vh; padding-bottom:2vh; height:auto; min-height:56vh; border:1px solid white;"></div>
		</div></div>
		<div id="optionsBar" style="float:left; width:21%; margin-left:1%; height:87vh; background: #000080;">
		<div id="formBox" style="float:none; width:96%; margin-left:auto; margin-right:auto; height:18%; margin-top:2%; border:1px solid white; text-align:center; clear:both;"></div>
		<div id="controlBox" style="float:none; width:96%; margin-left:auto; margin-right:auto; height:21%; margin-top:2%; border:1px solid white; color:#FFF; clear:both;"></div>
		<div id="buttonBox" style="float:none; width:96%; margin-left:auto; margin-right:auto; height:16%; margin-top:2%; border-top:1px solid white; border-left:1px solid white; border-right:1px solid white; clear:both;"></div>
		<div id="enterText" style="float:none; width:96%; margin-left:auto; margin-right:auto; height:32%; border-left:1px solid white; border-right:1px solid white; border-bottom:1px solid white;"></div>
		<div id="submitBox" style="float:none; width:96%; margin-left:auto; margin-right:auto; height:7%; margin-top:2%; clear:both;"></div></div>
		</div>
	</div>