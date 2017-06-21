<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nimbus</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<style>
		#findtype { float:right; width:45%; height:100%; margin-right:2%; }
		#findCustom { float:right; width:45%; height:100%; margin-right:2%; }
		#backCUP { width:45%; float:left; height:100%; margin-left:2%; opacity:0;}
		</style>
    </head>
	<?php if (login_check($mysqli) == true) : ?>
	<body>
	<div style="width:85vw; height:90vh; margin-top:5vh; float:none; margin-left:auto; margin-right:auto;">
	
	<div style="float:left; width:25%; margin-right:2%; height:100%; background: #000080;">
	<div style="float:left; width:99%; border-bottom:1px solid white; height:24%; margin-bottom:1%; text-align:center; font-size:2vw; color:#FFF;"><span style="float:none;margin-left:auto; margin-right:auto;">Preset Document</span>
		<div id="listhold" style="float: none; clear: left; width:100%; height:28%; margin-left: auto; margin-right: auto; padding-top: 1vw; overflow:hidden;">
			<select name="category" id="category" style="width:100%;height:3vw;text-align:center;font-size:1.3vw;">
		<?php
		$optionList = '';
		$jQueryF = '';
		$functionC = '';
		$countList = 0;
		$listQuery = $mysqli->prepare("SELECT categoryID, name, groupID, contains, groupfiles FROM presetCat WHERE contains != 0");
		$listQuery->execute();
		$listQuery->bind_result($catID, $name, $groupID, $contains, $groupfiles);
		while ($listQuery->fetch()) {
		$countList++;
		$getNames = '';
		$optionList.= '<option name="'.$groupID.'" value="'.$catID.'" style="height:3vw;">'.$name.'</option>';
		$jQueryF.= 'if (formID == '.$catID.') { formV = "<form id='."'".$groupID."' name='".$groupID."' method='POST' action='presets/findform.php?formID=".$catID."'><select name='getform' id='getform' style='width:100%;height:3vw;text-align:center;font-size:1.3vw;'>";
		$getNames[] = explode(',', $groupfiles);
		$contains = $contains - 1;
		for ($f = 0; $f <= $contains; $f++) {
		$titleOp = $getNames[0][$f];
		$titleOp = substr($titleOp, 0, -4);
		$titleOp = str_replace('_', ' ', $titleOp);
		$titleOp = ucfirst($titleOp);
		$jQueryF.= "<option name='".$titleOp."' value='".$f."' style='height:3vw;'>".$titleOp."</option>";
		}
		$jQueryF.= '</select></form>"; markForm = "'.$groupID.'";}
		';
		if ($countList >= 2) { $functionC.= 'else if (FValue == '.$countList.') {	AddForm('.$countList.'); } 
		'; }
		}
		echo $optionList;
		?>
			</select>
		</div>
		<div id="cbox" style="float:left; height:25%; width:100%; padding-top:0.7vw; clear:left;"><button id="findtype" name="findtype" type="submit"><span id="cButtonText">Select Category</span></button></div>
		<script>
		var FirstClick, FValue, formV, markForm;
		FirstClick = 0;
		
		function AddForm(formID) {
		<?php
		global $jQueryF;
		echo $jQueryF;
		?>
		$("#listhold").stop().animate({"height":"0%"}, 500);
		$("#cButtonText").stop().animate({"opacity":"0"}, 500);
		setTimeout(function() {$("#listhold").empty(); $("#cButtonText").empty(); }, 500);
		setTimeout(function() {$("#listhold").append(formV).stop().animate({"height":"28%"}, 500); 
		$('<button>', {id:"backCUP"}).append("Go Back").appendTo("#cbox").stop().animate({"opacity":"1"}, 500); 
		$("#cButtonText").append("Select Form").stop().animate({"opacity":"1"}, 500);
		$("#findtype").attr("form", markForm); }, 600);
		}
		
		$("#findtype").mousedown(function() {
		if (FirstClick == 0) {
		FirstClick = 1;
		FValue = $("#category").val();
		if (FValue == 1) { AddForm(1); }
		<?php
		global $functionC;
		echo $functionC;
		?>
		}
		else if (FirstClick == 1) {
		
		}
		});
		</script>
	</div>
		<div style="float:left; width:99%; height:24%; margin-bottom:1%; text-align:center; font-size:2vw; color:#FFF;"><span style="float:none;margin-left:auto; margin-right:auto;">Custom Document</span>
		<div id="listhold2" style="float: none; clear: left; width:100%; height:28%; margin-left: auto; margin-right: auto; padding-top: 1vw; overflow:hidden;">
			<select name="categoryCustom" id="categoryCustom" style="width:100%;height:3vw;text-align:center;font-size:1.3vw;"><option value="1" style="height:3vw;">Coming Soon</option></select>
		</div>
		<div id="custombox" style="float:left; height:25%; width:100%; padding-top:0.7vw; clear:left;"><button id="findCustom" name="findCustom"><span id="cButtonText2">Select Form</span></button></div>
	</div>
	<div style="float:left; width:99%; border-bottom:1px solid white; border-top:1px solid white; height:10%; margin-top: 3vw; margin-bottom:1%; clear:left; text-align:center; font-size:2vw; color:#FFF;">View Documents</div>
	<div style="float:left; width:99%; border-bottom:1px solid white; height:10%; margin-bottom:1%; clear:left; text-align:center; font-size:2vw; color:#FFF;">Add Form</div>
	<div style="float:left; width:99%; border-bottom:1px solid white; height:10%; margin-bottom:1%; clear:left; text-align:center; font-size:2vw; color:#FFF;">View Forms</div>
	<div style="float:left; width:99%; border-bottom:1px solid white; height:10%; clear:left; text-align:center;"><a href="includes/logout.php" style="font-size:2vw; color:#FFF;">Log Out</a></div></div>
	
	<div style="float:left; width:46%; margin-right:2%; height:100%; background: #000080;"><div style="height:40%; width:90%; float:none; margin-left:auto; margin-right:auto;"><span style="float:left; font-size:2.5vw; color:#FFF;">Welcome Test User</span></div></div>
	
	<div style="float:left; width:25%; height:100%; background: #000080;"></div>
	</div>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="/Nimbus/index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>