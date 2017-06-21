	<div style="width:96vw; float:none; margin-left:auto; margin-right:auto; height:93vh; margin-top:3vh; background:rgba(255,255,255,0.7);">
	<div style="float:left; height:10vh; width:100%; border-bottom:1px solid white; background: #000080;"><div style="width:20%; float:left; height:100%;"><a href="/Nimbus/Admin.php" style="font-size:2vw; color:#FFF;">Home</a></div></div>
	<div style="float:left; height:auto; width:100%; clear:left;">
		<div style="float:right; width:100%; height:82%; margin-top:3vh;">
		<span style="font-size:3vw; float:left; color:#000;">Add Preset Form</span>
			<div style="float:left; width:100%; margin-top: 2vh; clear:left;">
			<?php
			$FillForm = '<select id="addtocat" name="addtocat" style="float:left; width:33%; margin-left:2%; margin-right:2%;">';
			$grabCategory = "SELECT name, groupID FROM presetCat ORDER BY name ASC";
			$retCategory = $mysqli->prepare($grabCategory);
			$retCategory->execute();
			$retCategory->bind_result($cName, $cGroup);
			while ($retCategory->fetch()) {	$FillForm.= '<option value="'.$cGroup.'">'.$cName.'</option>'; }
			$retCategory->close();
			$FillForm.= '</select>';
			$iForm = '<div style="float:left; width:70%;"><div style="float:left; width:15%; height:5vh; clear:left; color:#000;">Select Category: </div>'.$FillForm.'<div style="float:left; width:15%; height:5vh; color:#000;">Add Columns</div><input id="formnumber" name="formnumber" type="text" style="float:left; margin-left: -2%; width: 8%;"/><div style="float:left; clear:left; width:25%;"><button id="createform" name="createform" style="width:100%; height:5vh;">Create Form</button></div></div>';
			echo $iForm;
			?>
			<script>
			$("#createform").on("click", function() {
			var getColumnNumber = $("#formnumber").val();
			var getCategoryName = $("#addtocat").val();
			$.ajax({
				type: "POST",
				url: "adm_function/create_forms.php",
				data: { formnumber: getColumnNumber, addtocat: getCategoryName },
				success: function(rData) { $("body").empty(); $("body").html(rData); }
				});
			});
			</script>
			</div>
		</div>
	</div>
	</div>