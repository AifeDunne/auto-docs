<?php
	if (isset($_POST['formnumber'])) {
	if (isset($_POST['addtocat'])) {
	include_once $_SERVER['DOCUMENT_ROOT'].'/Nimbus/includes/db_connect.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/Nimbus/includes/functions.php';
	sec_session_start();
	
	$addForms = $_POST['formnumber'];
	$addForms = intval($addForms);
	$categoryName = $_POST['addtocat'];
	$formAdd = '<form id="submitform" id="submitform" method="post" action="adm_function/submit_form.php?colCount='.$addForms.'&category='.$categoryName.'">
	<div style="float:left; clear:both; font-size:2vw; width:38vw; margin-bottom:2.5vw;"><span style="float:left;">Form Title: </span><input name="ftitle" id="ftitle" type="text" style="float:left; width:56%; margin-left:0.5vw; height: 2vw;" /></div>
	<hr style="clear:left; background-color: #d3d3d3; height: 1px; border: 0;">';
		for ($f = 1; $f <= $addForms; $f++) {
		$formAdd.= '<div id="'.$f.'" style="float:left; clear:left; width:100%; height:8vh; padding-top:2vh; border-bottom:1px solid #d3d3d3;"><div style="float:left; width:14%;"><span style="font-size:1.5vw; float:left;color:#000;">'.$f.'.</span><textarea name="elemlabel['.$f.']" id="elemlabel['.$f.']" rows="1" cols="26" placeholder="Question" style="width:78%; float:right; height:2vw;" /></textarea></div>
		<div style="float:left; width:10%; margin-left:0.5vw;"><select id="enterform['.$f.']" name="enterform['.$f.']" class="selectMenu""><option></option><option name="DATE" value="DATE">- DATE</option><option name="TEXTF" value="TEXTF">- TEXT FIELD</option><option name="NUMBER" value="NUMBER">- NUMBER</option><option name="mChoice" value="MULTIPLE">- MULTIPLE CHOICE</option><option name="QUESTION" value="QUESTION">- QUESTIONNAIRE</option><option name="IF" value="IF">- IF STATEMENT</option></select></div><div style="float:right; width:10%;"><textarea name="taglabel['.$f.']" id="taglabel['.$f.']" rows="1" cols="26" placeholder="Element Tag" style="width:100%; float:left; height:2vw;" /></textarea></div></div>';}
		$formAdd.= '<button id="addelements" id="addelements" type="submit" form="submitform" style="float:left; clear:left; margin-top:2vh;">Add Preset Form</button></form>';
		
		$inputS = "<div class='multiName'><span style='float:left;'>Button Label</span><input id='multi".'"'."+rCount+".'"'."[".'"'."+rCount+".'"'."][".'"'."+i+".'"'."]' name='multi".'"'."+rCount+".'"'."[".'"'."+rCount+".'"'."][".'"'."+i+".'"'."]' type='text' style='float:left; width:95%;'></div>";
		$inputT = "<div class='multiNameB'><span style='float:left;'>Button Label</span><input id='multi".'"'."+rCount+".'"'."[".'"'."+rCount+".'"'."][".'"'."+i+".'"'."]' name='multi".'"'."+rCount+".'"'."[".'"'."+rCount+".'"'."][".'"'."+i+".'"'."]' type='text' style='float:left; width:95%;'></div>";
		$inputOp = "<option value='0'>0</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option>";
		$inputType1 = "<select name='fType[".'"+rCount+"'."]' id='fType[".'"+rCount+"'."]' class='fType' style='width:100%;'><option value='radio'>Buttons</option><option value='select'>Drop Menu</option></select>";
		$inputType2 = "<select id='selectType".'"'."+rCount+".'"'."[".'"'."+getFString+".'"'."][".'"'."+count3+".'"'."]' name='selectType".'"'."+rCount+".'"'."[".'"'."+getFString+".'"'."][".'"'."+count3+".'"'."]' style='width:25%;top:0px;height:2vw;'><option value='radio'>Buttons</option><option value='select'>Drop Menu</option><option value='text'>Text</option></select>";
		$questionS = "<div id='question".'"+i+"'."' style='float:left;margin-top: -1.2vw;'><span style='float:left;'>Answer</span><input id='question"."[".'"'."+rCount+".'"'."][".'"'."+i+".'"'."]' name='question"."[".'"'."+rCount+".'"'."][".'"'."+i+".'"'."]' type='text' placeholder='Enter Answer' style='float:left;width:80%;height:4vh;clear:left;'><select id='addQ"."[".'"'."+rCount+".'"'."][".'"+i+"'."]' name='addQ"."[".'"'."+rCount+".'"'."][".'"+i+"'."]' class='getQC'".'style='."'float:left;'".'>"+questionCount+"</select></div>';
		
		$formAdd.= '<script>
		var value, value2, value3, value4, value5, getName, count, count2, count3, count4, count5, rCount, menuName, buttonName, buttonName2, questionCount;
		var getQ, getV, getV2, getV3, getV4, FirstClick, FirstR, SecondR, getN, getF, getHeight, getHeight2, FinalHeight, newHeight, menuChange;
		count = 0; count2 = 0; count3 = 0; count4 = 0; FirstClick = 0; FirstR = 0; SecondR = 0;
		menuChange = [];
		$(".selectMenu").change(function(){
		value = $(this).val();
		getName = $(this).parent().parent().attr("id");
		rCount = parseInt(getName);
		menuName = "Row"+getName+"Menu";
		if (value == "TEXTF") {
		$("#"+getName).append("<div id='."'".'"+menuName+"'."'".' style='."'float:left; margin-top: -0.1vw;'".'><select id='."'getText[".'"'."+rCount+".'"'."][0]'".'name='."'getText[".'"'."+rCount+".'"'."][0]'".'>'.$inputOp.'</select><input type='."'checkbox'".' id='."'getText[".'"'."+rCount+".'"'."][1]'".'name='."'getText[".'"'."+rCount+".'"'."][1]'".' value='."'1'".'>Break Lines</div>");
		menuChange.push("#"+getName);
		}
		else if (value == "MULTIPLE") {
		count++;
		$("#"+getName).append("<div id='."'".'"+menuName+"'."'".' style='."'float:left;'".'><select class='."'getButton'".'>'.$inputOp.'</select></div>");
		$(".getButton").change(function(){
		value2 = $(this).val();
		$("#"+menuName).remove();
		buttonName = "buttonDiv"+count;
		$("#"+getName).append("<div id='."'".'"+buttonName+"'."'".' class='."'MultipleA'".'></div>");
		for (i = 0; i < value2; i++) {
		$("#"+buttonName).append("'.$inputS.'");}
				});
			}
		else if (value == "QUESTION") {
		count2++;
		questionCount = "";
		$("#"+getName).append("<div id='."'".'"+menuName+"'."'".' style='."'float:left;'".'><select class='."'getQuestion'".'>'.$inputOp.'</select></div>");
		menuChange.push("#"+getName);
		$(".getQuestion").change(function(){
		value2 = $(this).val();
		getV = parseInt(value2);
		getV = getV + 1;
		for (q = 0; q < 5; q++) { questionCount = questionCount+"<option value="+q+">"+q+"</option>";}
		$("#"+menuName).empty();
		$("#"+menuName).css({"width":"5%"}).append("'.$inputType1.'");
		buttonName2 = "questionDiv"+count2;
		$("#"+getName).append("<div id='."'".'"+buttonName2+"'."'".' class='."'MultipleB'".'></div>");
		for (i = 1; i < getV; i++) { $("#"+buttonName2).append("'.$questionS.'"); }
				$(".getQC").change(function(){
				getHeight2 = 15;
				getHeight = 15;
				value3 = $(this).val();
				getV2 = parseInt(value3);
				getV2 = getV2 + 1;
				getQ = "";
				var getFString = $(this).parent().attr("id");
				getFString = getFString.substr(8);
				getN = "question"+rCount;
				for (v = 1; v < getV2; v++) { count4++; getQ = getQ+"<div style='."'width:100%; float:left; clear:left;'>".'<input name="+getN+"["+rCount+"]["+count4+"] id="+getN+"["+rCount+"]["+count4+"]'."'"."type='text' style='float:left;clear:left;height:3vh;' placeholder='Question".'"+v+"'."'".' /><select id='."'getAnswer".'"+rCount+"["+getFString+"]["+v+"]'."'"." name="."'getAnswer".'"+rCount+"["+getFString+"]["+v+"]'."'"." class='getAnswer' style='height:4vh;'".'>'.$inputOp.'</select></div>"; }
				if (FirstClick == 0) {
				FirstClick = 1;
				$("#"+getName).stop().animate({"height": getHeight2}, 500);
				}
				getHeight2 = (getV2 * 3) + getHeight2;
				newHeight = getHeight2+"vh";
				$("#"+getName).stop().animate({"height": newHeight}, 500);
				$(this).parent().append(getQ);
				$(this).hide();
					$(".getAnswer").change(function(e){
					e.stopImmediatePropagation();
					count3++;
					value4 = $(this).val();
					getV3 = parseInt(value4);
					getV3 = getV3 + 1;
					getF = "";
					var getString = $(this).parent().find("select").attr("id");
					getString = getString.substr(9);
					getString = getString.substr(-6);
					for (f = 1; f < getV3; f++) { getF = getF+"<input name='."'submenu".'"+rCount+"["+getFString+"]["+count3+"]["+f+"]'."'".' id='."'submenu".'"+rCount+"["+getFString+"]["+count3+"]["+f+"]'."' type='text' style='float:left;clear:left;height:3vh;' placeholder='Answer".'"+f+"'."'".' />"; }
					getHeight = (getV3 * 3) + getHeight;
					FinalHeight = getHeight+"vh";
					$("#"+getName).stop().animate({"height": FinalHeight},500);
					$(this).parent().css({"height":"auto"}).append(getF);
					getF = "";
					$(this).hide();
					$(this).parent().append("'.$inputType2.'");
					$(this).parent().append();
					})
					});
			});
		}
		else if (value == "IF") {
		count5++;
		var AddHTML; AddHTML = "";
		$("#"+getName).append("<div id='."'".'"+menuName+"'."'".' style='."'float:left;'".'><select class='."'getIf'".'>'.$inputOp.'</select></div>");
		$(".getIf").change(function(ev){
		ev.stopImmediatePropagation();
		value5 = $(this).val();
		getV4 = parseInt(value5);
		getV4 = getV4 + 1;
		$("#"+menuName).remove();
		ifName = "ifDiv"+count;
		console.log(menuChange);
		$("#"+getName).append("<div id='."'".'"+ifName+"'."'".' class='."'MultipleA'".'></div>");
		AddHTML = AddHTML + "<option></option>";
		jQuery.each( menuChange, function(index, value) {
		AddHTML = AddHTML + "<option name='."'".'"+value+"'."'".' value='."'".'"+value+"'."'".'>Item "+value+"</option>";
		});
		for (i = 1; i < getV4; i++) {
		$("#"+ifName).append("'.$inputT.'<select id='."ifMenu".'["+rCount+"]["+i+"] name='."ifMenu".'["+rCount+"]["+i+"] style='."'float:left;margin-right: 0.5vw;'".'>"+AddHTML+"</select>");}
				});
		}
		});
		</script>
		';
	$_SESSION['fullform'] = $formAdd;
	header('Location: /Nimbus/adm/add_preset.php');
	} else { echo "Please select a category first"; }
	} else { echo "Please fill out the number of columns"; }
?>