<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Preset</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<style>
		.MultipleA {float:left; margin-left:1vw; width:62%;}
		.MultipleB {float:left; margin-left:1vw; width:59%;}
		.MultipleC {float:right; width:48%;}
		.multiName {float:left; width:17%; margin-top: -1.2vw; margin-right: 0.5vw;}
		.multiNameB {float:left; width:17%; margin-top: -1.2vw;}
		.multiQ {float:left; width:100%; clear:left; margin-top:0.5vw;}
		</style>
    </head>
	<?php if (login_check($mysqli) == true) : ?>
	<body>
	<div style="width:96vw; float:none; margin-left:auto; margin-right:auto; height:93vh; margin-top:3vh; background:rgba(255,255,255,0.7);">
	<div style="float:left; height:10vh; width:100%; border-bottom:1px solid white; background: #000080;"><div style="width:20%; float:left; height:100%;"><a href="/Nimbus/Admin.php" style="font-size:2vw; color:#FFF;">Home</a></div></div>
	<div style="float:left; height:auto; width:100%; clear:left;">
		<div style="float:right; width:100%; height:82%; margin-top:3vh;">
		<span style="font-size:3vw; float:left; color:#000;">Add Preset Form</span>
			<div style="float:left; width:100%; margin-top: 2vh; clear:left;">
			<?php
			if (!empty($_SESSION['fullform'])) {
			$currentForm = $_SESSION['fullform'];
			echo $currentForm;
			unset($_SESSION['fullform']);
			} else {
			$FillForm = '<select id="addtocat" name="addtocat" style="float:left; width:33%; margin-left:2%; margin-right:2%;">';
			$grabCategory = "SELECT name, groupID FROM presetCat ORDER BY name ASC";
			$retCategory = $mysqli->prepare($grabCategory);
			$retCategory->execute();
			$retCategory->bind_result($cName, $cGroup);
			while ($retCategory->fetch()) {	$FillForm.= '<option value="'.$cGroup.'">'.$cName.'</option>'; }
			$retCategory->close();
			$FillForm.= '</select>';
			$iForm = '<div style="float:left; width:70%;"><div style="float:left; width:15%; height:5vh; clear:left; color:#000;">Select Category: </div><form id="pickform" name="pickform" method="POST" action="adm_function/create_forms.php">'.$FillForm.'<div style="float:left; width:15%; height:5vh; color:#000;">Add Columns</div><input id="formnumber" name="formnumber" type="text" style="float:left; margin-left: -2%; width: 8%;"/><div style="float:left; clear:left; width:25%;"><button id="createform" name="createform" type="submit" form="pickform" style="width:100%; height:5vh;">Create Form</button></div></form></div>';
			echo $iForm;
			}
			?>
			</div>
		</div>
	</div>
	</div>
	<?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="/Nimbus/index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>