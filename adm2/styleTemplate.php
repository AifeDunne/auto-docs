<div id="sideBar" style="float:left; width:100%; height:8vh; background: #000080;">
	<span style="float:left;margin-left:3%;color:#FFF;font-size:2vw; line-height: 3.5vw;">Add Formatting</span>
	<div id="listhold" style="float: left; width:20%; height:90%; margin-top: 1vh; margin-left:3%; margin-right:1%;">
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
		$jQueryF.= 'if (formID == '.$catID.') { formV = "<form id='."'".$groupID."' name='".$groupID."'><select name='getform' id='getform' style='width:100%;height:3vw;text-align:center;font-size:1.3vw;'>";
		$getNames[] = explode(',', $groupfiles);
		$contains = $contains - 1;
		for ($f = 0; $f <= $contains; $f++) {
		$titleOp = $getNames[0][$f];
		$titleOp = substr($titleOp, 0, -4);
		$titleOp = str_replace('_', ' ', $titleOp);
		$titleOp = ucfirst($titleOp);
		$jQueryF.= "<option name='".$titleOp."' value='".$f."' style='height:3vw;'>".$titleOp."</option>";
		}
		$jQueryF.= '</select></form>"; catID = '.$catID.';}
		';
		if ($countList >= 2) { $functionC.= 'else if (FValue == '.$countList.') { AddForm('.$countList.'); }
		'; }
		}
		echo $optionList;
		?>
			</select>
		</div>
		<div id="cbox" style="float:left; height:100%; width:20%;"><button id="findtype" name="findtype" style="width:45%;"><span id="cButtonText">Select Category</span></button></div>
		<script>
		var FirstClick, FValue, formV, catID, getForm, num, textCount, headerCount, dCount, dFC, fullWidth, returnData, wordHover;
		FirstClick = 0;
		textCount = 0;
		headerCount = 0;
		itemCount = 0;
		fontClick = 0;
		dFC = 0;
		dCount = [];
		
		function ConvertForm(form, label, elemNumber) {
		var makeStyle = "<div id='form"+elemNumber+"' class='dragButton "+form+"' style='display:inline; float:right; height:auto; color:#000; background: #FFF; padding: 2px; border:2px solid #000080; cursor:pointer;'><div id='menu"+elemNumber+"' class='formObject' style='display:inline; font-size:26px; background: #FFF;'>"+label+"</div></div><div style='clear:both; width:100%; height:1.5vh;'></div>";
		$("#presetHolder").append(makeStyle);
		}
		
		var fontMenu, fontForm, defFont;
		function findCFont(pixels) {
		if (pixels == 0) {
		fontMenu = "<option name='font8' value='8px'>8</option><option name='font12' value='12px'>12</option><option name='font16' value='16px'>16</option><option name='font18' value='18px'>18</option><option name='font22' value='22px'>22</option><option name='font26' value='26px' selected='selected'>26</option><option name='font32' value='32px'>32</option><option name='font36' value='36px'>36</option><option name='font42' value='42px'>42</option>";
		return fontMenu; }
		if (pixels != 0) {
		fontMenu = '';
		fontForm = pixels;
		fontForm = fontForm.substr(0, 2);
		fontForm = parseInt(fontForm);
		defFont = ['',8,12,16,18,22,26,32,36,42];
		for (f = 1; f < 9; f++) { if (fontForm == defFont[f]) {
		fontMenu = fontMenu + "<option name='font"+defFont[f]+"' value='"+defFont[f]+"px' selected='selected'>"+defFont[f]+"</option>";
		} else {fontMenu = fontMenu + "<option name='font"+defFont[f]+"' value='"+defFont[f]+"px'>"+defFont[f]+"</option>";}
				}
		return fontMenu;
			}
		}
		
		var divWidth, boxDuel, finalString, itemCount, sLeft, sTop;
		finalString = '';
		boxDuel = 0;
		function StartPage() {
		var cFont = findCFont(0);
		$("#formBox").append("<span style='font-size:2vw; color:#FFF;'>Format</span><select id='styleform' name='styleform' style='height:2.5vw; width:95%; clear:both;'><option name='A4' value='a4'>A4</option><option name='Legal' value='legal'>Legal</option><option name='Letter' value='letter'>Letter</option></select><div style='float:left; margin-top:1vh; width:100%;'><span style='float:left; margin-left:2%; margin-right:2%; font-size:1.5vw; color:#FFF;'>Document Font-Size: </span><select id='docFont' name='docFont' style='float:left; width:3vw; height:4vh;'>"+cFont+"</select><span style='float:left; margin-left:2%; margin-right:2%; font-size:1.5vw; color:#FFF;'>px</span></div>");
		$("#buttonBox").append("<div style='float:left;width:90%; margin-left:5%; margin-top:2%; clear:both;'><select id='addBox' name='addBox' style='width:100%; height:2.5vw;'><option name='addText' value='TEXT'>Subject Text</option><option name='addTitle' value='HEADER'>Header</option><option name='addHLine' value='HLINE'>Horizontal Line</option><option name='addVLine' value='VLINE'>Vertical Line</option></select></div><div style='float:left;width:90%; margin-left:5%; margin-top:2%; clear:both;'><button id='addStyle' name='addStyle' style='width:100%; height: 2.5vw;'>Add</button></div>");
		$("#submitBox").append("<button id='submitFormat' name='submitFormat' style='width:100%; height: 100%;'>Submit Format</button>");
		fullWidth = $("#styleArea").width();
		
		var newW, newH;
		$("#styleform").change(function(){
		var FormatVal = $(this).val();
		switch(FormatVal) {
		case 'a4': newW = '595.28px'; newH = '841.89px'; break;
		case 'legal': newW = '612px'; newH = '1008px'; break;
		case 'letter': newW = '612px'; newH = '792px'; break;
			}
			$("#styleArea").stop().animate({"width":newW, "height":newH},500);
			fullWidth = newW;
			});
		$("#docFont").change(function(){ fontForm = $(this).val(); fontMenu = findCFont(fontForm); $(".formObject").css({"fontSize":fontForm}); $(".bodyText").css({"fontSize":fontForm}); $(".duplicate").css({"fontSize":fontForm});});
		
		$("#addStyle").mousedown(function() {
		var menuSelect = $("#addBox").val();
		if (menuSelect == 'HEADER') { 
		if (boxDuel == 0) {
		boxDuel = 1;
		headerCount++;
		$("#enterText").append("<div id='titleholder' style='height:100%; width:100%;'><textarea name='titlebox' id='titlebox' style='float:left; width:98%; height:55%;'>Add your header title here</textarea><button id='submitTitle' name='submitTitle' style='float:left; height:12%; width:100%; margin-top:2%; clear:left;'>Add Header</button></div>");
		$("#submitTitle").mousedown(function() {
		var thisHeader = $("#titlebox").val();
		$("#titleholder").remove();
		$("#styleArea").append("<div id='Header"+headerCount+"' style='float:left; color:#000; font-size:36px; cursor:pointer;'>"+thisHeader+"</div>");
		$("#Header"+headerCount).draggable({containment: $("#Header"+headerCount).parent().parent()});
		boxDuel = 0;
		});
		} else { return false; }
		}
		else if (menuSelect == 'TEXT') {
		if (boxDuel == 0) {
		boxDuel = 1;
		textCount++;
		$("#enterText").append("<div id='textholder' style='height:100%; width:100%;'><textarea name='textbox' id='textbox' style='float:left; width:98%; height:82%;'>Add your text here</textarea><button id='submitText' name='submitText' style='float:left; height:15%; width:100%; clear:left;'>Add Text</button></div>");
		$("#addStyle").hide();
		$("#buttonBox").append("<div id='pText' name='addStyle' style='width:100%; height: 2.5vw;'><span style='float:left; margin-left:2%; margin-right:2%; font-size:1.5vw; color:#FFF;'>Text Size: </span><select id='pFont' name='pFont' style='float:left; width:3vw; height:4vh;'>"+fontMenu+"</select></div>");
		$("#submitText").mousedown(function() {
		var thisText = $("#textbox").val();
		var BodyText = $("#pFont").val();
		$("#textholder, #pText").remove();
		$("#addStyle").show();
		var maximumW = $("#styleArea").width();
		$("#styleArea").append("<div id='Text"+textCount+"' class='bodyText' style='float:left; display:inline; max-width:"+maximumW+"; clear:left; color:#000; font-size:"+BodyText+"; cursor:pointer;'><span id='spanText"+textCount+"' class='paragraphText"+textCount+"' style='float:left; display:inline;'>"+thisText+"</span></div>");
		$("#Text"+textCount).css({"width":"auto", "maxWidth": maximumW});
		$("#Text"+textCount).draggable({ containment: $("#Text"+textCount).parent().parent() });
		$(".paragraphText"+textCount).css({"maxWidth":maximumW}).lettering('words');
		$(".paragraphText"+textCount).children().each(function(i, obj) { $(this).attr("id", "s"+textCount+"Text"+i); });
		$('span[class*="word"]').addClass("TextWord");
		$('span[class*="word"]').on({
		mouseenter: function() { wordHover = true; $(this).css({"fontWeight":"bold"}); },
		mouseleave: function() { wordHover = false; $(this).css({"fontWeight":"normal"}); }
			});
		boxDuel = 0;
		});
		} else { return false; }
		}
		});
		
		var bClick, thisB;
		bClick = 0;
		function AppendTextC(ttName) {
		$("#controlBox").append("<div style='text-align:center; font-size:2vw; clear:both;'>"+ttName+"</div><div id='changeBoxT' style='float:left; width:90%; margin-left:5%; height:auto; margin-top:5%;'><span style='float:left; margin-left:2%; margin-right:2%; font-size:1.5vw;'>Font-Size: </span><select id='textSize' name='textSize' style='float:left;'>"+fontMenu+"</select><div style='clear:both; height:0.5vh' /><span style='float:left; margin-left:2%; margin-right:2%; font-size:1.5vw;'>Width: </span><span style='float:left; margin-right:2%;'>◄</span><span style='float:left;'>►</span></div>");
		$("#textSize").change(function(){ var getTFont = $(this).val(); $("#"+ttName).css({"fontSize":getTFont}); });
		}
		$(".bodyText").mousedown(function() {
		var crntCTName = $(this).attr("id");
		function retrieveText(cTName) { $("#controlBox").empty(); var crntTWidth = $("#"+crntCTName).width(); AppendTextC(crntCTName); }
		if (bClick == 0) { thisB = crntCTName; retrieveText(thisB); bClick = 1; }
		if (thisB != crntCTName) { thisB = crntCTName; retrieveText(thisB);}
		});
		
		function Duplicate() {
		dFC++;
		var createF = thisB.substr(4);
		var fID = createF;
		var upCount = dCount[fID];
		upCount = upCount + 1;
		dCount[fID] = upCount;
		var cContent = $("#form"+createF).text();
		var dSize = $("#form"+createF).find(".formObject").attr("id");
		dSize = $("#"+dSize).css('font-size');
		var duplicateStyle = "<div id='form"+createF+"D"+upCount+"' class='duplicate form"+createF+"' style='display:inline; float:right; height:auto; color:#000; background: #FFF; padding: 2px; border:2px solid #000080; font-size:"+dSize+"; cursor:pointer;'>"+cContent+"</div><div style='clear:both; width:100%; height:1.5vh;'></div>";
		$("#presetHolder").append(duplicateStyle);
		$("#form"+createF+"D"+upCount).draggable({ containment: $("#form"+createF+"D"+upCount).parent().parent()}).addClass("dragButton").mousedown(function() {$(this).bind("drag",showOverlap); $(this).bind("dragstop",showOverlap); }).mouseup(function() {$(this).unbind("drag"); $(this).unbind("dragstop"); getDrop(); 	
			});
		}
		
		function AppendControls(eName, eID, childID, attachC) {
		$("#controlBox").append("<div style='text-align:center; font-size:2vw; clear:both;'>"+eName+"</div><div id='changeBox' style='float:left; width:90%; margin-left:5%; height:auto; margin-top:5%;'><span style='float:left; margin-left:2%; margin-right:2%; font-size:1.5vw;'>Font-Size: </span><select id='fontSize' name='fontSize' style='float:left;'>"+fontMenu+"</select><div style='clear:both; height:0.5vh' /><span style='float:left; margin-left:2%; margin-right:2%; font-size:1.5vw;'>Duplicate: </span><button id='duplicateForm' name='duplicateForm'>Create Element</button><div style='clear:both; height:0.5vh' /><span style='float:left; margin-left:2%; margin-right:2%; font-size:1.5vw;'>Re-Assign: </span><button id='removeFrom' name='removeFrom'>Unattach Element</button></div>");
		$("#fontSize").change(function(){ var getFont = $(this).val(); $("#"+childID).css({"fontSize":getFont}); });
		$("#duplicateForm").mousedown(Duplicate);
		}
		$(".formObject").mousedown(function() {
		var crntCName = $(this).attr("id");
		function findRequired(cName) {
		var crntName = $("#"+cName).text();
		var parentID = $("#"+cName).parent().attr("id"); 
		var uAttached = $("#"+parentID).attr('class').split(' ');
		if (uAttached[0] == "dragButton") {	var qAttach = 'No'; }
		else {var qAttach = 'Yes';}
		$("#controlBox").empty();
		AppendControls(crntName, parentID, crntCName, qAttach);	}
		if (bClick == 0) { thisB = crntCName; findRequired(thisB); bClick = 1; }
		if (thisB != crntCName) { thisB = crntCName; findRequired(thisB);}
		});
		
		$("#submitFormat").mousedown(function() {
		var FullName = $('#getform option[value="'+getForm+'"]').attr("name");
		sLeft = $("#styleArea").position();
		sTop = $("#styleArea").position();
		for (n = 0; n < num; n++) {
		itemCount++;
		var elementName = "#form"+itemCount;
		var elementType = $(elementName).attr('class').split(' ');
		if (elementType[0] == "dragButton") {
		var elementPos = $(elementName).position();
		var FixedLeft1 = elementPos.left - sLeft.left;
		var FixedTop1 = elementPos.top - sTop.top;
		finalString = finalString + "ELEMENT|"+itemCount+"|"+elementType[1]+"|"+FixedLeft1+"+]"+FixedTop1+"+>";
		} else {
		var spanPosition = elementType[1].split("=");
		var sayText = elementType[2].substr(9)
		finalString = finalString + "ATTACHED|"+itemCount+"|"+sayText+"|"+spanPosition[0]+"+]"+spanPosition[1]+"+>"; }
		}
		if (textCount > 0) {
		itemCount = 0;
		for (t = 0; t < textCount; t++) {
		itemCount++;
		var eachText = '';
		var textName = "#Text"+itemCount;
		var textPos = $(textName).position();
		var FixedLeft2 = textPos.left - sLeft.left;
		var FixedTop2 = textPos.top - sTop.top;
		$(".paragraphText"+itemCount).children().each(function(i, obj) {
		var wordClass = $(this).attr("class").split(" "); 
		if (wordClass[1] == 'TextWord') { eachText = eachText + $(this).text()+" "; }
		});
		finalString = finalString + "TEXT|"+itemCount+"|"+eachText+"|"+FixedLeft2+"+]"+FixedTop2+"+>";
			}
		}
		
		if (dFC > 0) {
		for (d = 1; d < num; d++) {
		var duplicateCount = dCount[d];
		for (z = 1; z < duplicateCount; z++) {
		var dupClass = $("#form"+d+"D"+z).attr("class").split(" ");
		if (dupClass[3] == "paragraphText"+d) {
		var dupPos = dupClass[2].split("=");
		finalString = finalString + "DUPLICATE|"+dupClass[1]+"|"+dupPos[0]+"|"+dupPos[1]+"|"+dupClass[3]+"+>"; }
		else {
		var duplicateS = $("#form"+d+"D"+z).position();
		finalString = finalString + "DUPLICATE|"+dupClass[1]+"|"+duplicateS.left+"+]"+duplicateS.top+"+>";	}
					}
				}
			}
		
		if (headerCount > 0) {
		itemCount = 0;
		for (h = 0; h < headerCount; h++) {
		itemCount++;
		var headerName = "#Header"+itemCount;
		var headPos = $(headerName).position();
		var FixedLeft3 = headPos.left - sLeft.left;
		var FixedTop3 = headPos.top - sTop.top;
		var headContent = $(headerName).text();
		finalString = finalString + "HEADER|"+itemCount+"|"+headContent+"|"+FixedLeft3+"+]"+FixedTop3+"+>";
			}
		}
		$.ajax({url:"/Nimbus/adm/adm_function/addformat.php", 
              data: {formID: FullName, fullArray: finalString},
              type:'post',
			  async: false,
              success: function(){ window.location.href = "/Nimbus/Admin.php"; }
			});
		});
		}
		
		function showOverlap(event2,ui) {
		returnData = '';
		event2.stopImmediatePropagation();
		event2.stopPropagation();
		collisions = $(this).collision( ".TextWord", { relative: "collider", obstacleData: "odata", colliderData: "cdata", directionData: "ddata", as: "<div/>" } );
				for( var i=0; i<collisions.length; i++ )
				{
				  var oData = $(collisions[i]).data("odata");
				  var cData = $(collisions[i]).data("cdata");
				  var dData = $(collisions[i]).data("ddata");
				}
				returnData = [oData, cData, dData];
				return returnData;
		}
		
		function getDrop() {
		var formW2 = $(this).width();
		var iBefore = '';
		var oData2 = returnData[0];
		var cData2 = returnData[1];
		var dData2 = returnData[2];
		returnData = '';
		if (oData2 != undefined) {
		var oData2A = oData2.attr("id");
		var oData2B  = oData2.attr("class").split(" ");
		cData2 = cData2.attr("id");
		$("#"+cData2).draggable( "disable" ).removeClass("dragButton ui-draggable ui-draggable-handle ui-draggable-disabled");
		var sParent2 = '';
		sParent2 = $("#"+oData2A).parent().attr("class");
		iBefore = "."+oData2B[0]+"#"+oData2A;
		if (dData2 == 'NE' || dData2 == 'E' || dData2 == 'SE') { var insertPos = 'BEFORE='+oData2A;
		$("#"+cData2).css({"float":"none", "top":"auto", "left":"auto", "marginTop":"auto", "marginRight":"5px", "clear":"none"}).addClass(insertPos+" "+sParent2).insertBefore(iBefore);
		} else if (dData2 == 'NW' || dData2 == 'W' || dData2 == 'SW') { var insertPos = 'AFTER='+oData2A;
		$("#"+cData2).css({"float":"none", "top":"auto", "left":"auto", "marginTop":"auto", "marginLeft":"5px", "clear":"none"}).addClass(insertPos+" "+sParent2).insertAfter(iBefore);
				};
			};
		}
		
		function DragDrop() {
		$(".dragButton").draggable({containment: $(".dragButton").parent().parent()});
		$(".dragButton").mousedown(function() {	$(this).bind("drag",showOverlap); $(this).bind("dragstop",showOverlap); });
		$(".dragButton").mouseup(function(e2) {	$(this).unbind("drag"); $(this).unbind("dragstop"); getDrop(); });
		}
		
		function AddForm(formID) {
		<?php
		global $jQueryF;
		echo $jQueryF;
		?>
		$("#listhold").stop().animate({"height":"0%"}, 510);
		$("#cButtonText").stop().animate({"opacity":"0"}, 510);
		setTimeout(function() {$("#listhold").css({"opacity":"0"}).empty(); $("#cButtonText").empty(); }, 500);
		setTimeout(function() {$("#listhold").append(formV); }, 550);
		setTimeout(function() {$("#listhold").css({"opacity":"1"}).stop().animate({"height":"88%"}, 500); 
		$('<button>', {id:"backCUP"}).append("Go Back").appendTo("#cbox").stop().animate({"opacity":"1"}, 500); 
		$("#cButtonText").append("Select Form").stop().animate({"opacity":"1"}, 500);
		}, 600);
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
		getForm = $("#getform").val();
		$.ajax({
            type: "POST",
            url: "/Nimbus/presets/findform.php?formID="+catID+"&getform="+getForm,
            success: function(formData){
			var newArrays = formData.split("|",3);
			var arrayNum = newArrays[0];
			arrayNum = parseInt(arrayNum);
			var addNum = arrayNum + 1;
			var getData1 = newArrays[1].split(",",addNum);
			var getData2 = newArrays[2].split(",",addNum);
			dCount.push('');
			for (b = 0; b < addNum; b++) {
			dCount.push(0);
			num = b + 1;
			var bName = "execute"+b;
			ConvertForm(getData1[b],getData2[b],num);
			}
			StartPage();
			DragDrop();
			},
			error:function (xhr, ajaxOptions, thrownError) { alert(xhr); }
				});
		}
		});
		</script>
	<div style="float:right; height:100%; width:17%; margin-right:1%; text-align:center;"><a href="includes/logout.php" style="font-size:2vw; color:#FFF;">Log Out</a></div>
	</div>
	<div style="float:left; width:100%; height:100vh; margin-top:2vh;">
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