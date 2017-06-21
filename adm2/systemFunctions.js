var currentColumnNumber, currentCategoryName, currentFormString, addformContent, countAdd;
countAdd = 0;

function NavClick() {
var getTab = $(this).attr("id");
$(this).unbind();
if (getTab == "Tab1") { $("#page1").css({"width":"100%"}); $("#page2").css({"width":"0%"}); }
if (getTab == "Tab3") { $("#page1").css({"width":"0%"}); $("#page2").css({"width":"100%"}); }
$(this).bind("click",NavClick);
}

function FirstPage() {
var value, value2, value3, value4, value5, getName, rCount, menuName, questionCount, getF, menuChange;
		var count = 0; var count2 = 0; var count3 = 0; var count4 = 0; var count5 = 0; 
		menuChange = [];
		var inputOp = "<option value='0'>0</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option>";
		$(".formRow").sortable();

		$(".selectMenu").change(function(){
		value = $(this).val();
		getName = $(this).parent().parent().attr("id");
		rCount = parseInt(getName);
		menuName = "Row"+getName+"Menu";
		if (value == "TEXTF") {
		$("#"+getName).append("<div id='"+menuName+"' style='float:left; margin-top: -0.1vw; margin-left: 0.7vw;'><select id='getText["+rCount+"][0]' name='getText["+rCount+"][0]'>"+inputOp+"</select><input type='checkbox' id='getText["+rCount+"][1]' name='getText["+rCount+"][1]' value='1'>Break Lines</div>");
		menuChange.push("#"+getName);
		}
		else if (value == "MULTIPLE") {
		count++;
		$("#"+getName).append("<div id='"+menuName+"' style='float:left;'><select class='getButton'>"+inputOp+"</select></div>");
		$(".getButton").change(function(){
		value2 = $(this).val();
		$("#"+menuName).remove();
		var buttonName = "buttonDiv"+count;
		$("#"+getName).append("<div id='"+buttonName+"' class='MultipleA'></div>");
		for (i = 0; i < value2; i++) {
		$("#"+buttonName).append("<div class='multiName'><span style='float:left;'>Button Label</span><input id='multi"+rCount+"["+rCount+"]["+i+"]' name='multi"+rCount+"["+rCount+"]["+i+"]' type='text' style='float:left; width:95%;'></div>"); }
				});
			}
		else if (value == "QUESTION") {
		count2++;
		questionCount = "";
		$("#"+getName).append("<div id='"+menuName+"' style='float:left;'><select class='getQuestion'>"+inputOp+"</select></div>");
		menuChange.push("#"+getName);
		$(".getQuestion").change(function(){
		value2 = $(this).val();
		var getV = parseInt(value2);
		getV = getV + 1;
		for (q = 0; q < 5; q++) { questionCount = questionCount+"<option value="+q+">"+q+"</option>";}
		$("#"+menuName).empty();
		$("#"+menuName).css({"width":"5%"}).append("<select name='fType["+rCount+"]' id='fType["+rCount+"]' class='fType' style='width:100%;'><option value='radio'>Buttons</option><option value='select'>Drop Menu</option></select>");
		var buttonName2 = "questionDiv"+count2;
		$("#"+getName).append("<div id='"+buttonName2+"' class='MultipleB'></div>");
		for (i = 1; i < getV; i++) { $("#"+buttonName2).append("<div id='question"+i+"' style='float:left;margin-top: -1.2vw;'><span style='float:left;'>Answer</span><input id='question["+rCount+"]["+i+"]' name='question["+rCount+"]["+i+"]' type='text' placeholder='Enter Answer' style='float:left;width:80%;height:4vh;clear:left;'><select id='addQ["+rCount+"]["+i+"]' name='addQ["+rCount+"]["+i+"]' class='getQC' style='float:left;'>"+questionCount+"</select></div>"); }
				$(".getQC").change(function(){
				value3 = $(this).val();
				var getV2 = parseInt(value3);
				getV2 = getV2 + 1;
				var getQ = "";
				var getFString = $(this).parent().attr("id");
				getFString = getFString.substr(8);
				var getN = "question"+rCount;
				for (v = 1; v < getV2; v++) { count4++; getQ = getQ+"<div style='width:100%; float:left; clear:left;'><input name="+getN+"["+rCount+"]["+count4+"] id="+getN+"["+rCount+"]["+count4+"]' type='text' style='float:left;clear:left;height:3vh;' placeholder='Question"+v+"' /><select id='getAnswer"+rCount+"["+getFString+"]["+v+"]' name='getAnswer"+rCount+"["+getFString+"]["+v+"]' class='getAnswer' style='height:4vh;'>"+inputOp+"</select></div>"; }
				$(this).parent().append(getQ);
				$(this).hide();
					$(".getAnswer").change(function(e){
					e.stopImmediatePropagation();
					count3++;
					value4 = $(this).val();
					var getV3 = parseInt(value4);
					getV3 = getV3 + 1;
					getF = "";
					var getString = $(this).parent().find("select").attr("id");
					getString = getString.substr(9);
					getString = getString.substr(-6);
					for (f = 1; f < getV3; f++) { getF = getF+"<input name='submenu"+rCount+"["+getFString+"]["+count3+"]["+f+"]' id='submenu"+rCount+"["+getFString+"]["+count3+"]["+f+"]' type='text' style='float:left;clear:left;height:3vh;' placeholder='Answer"+f+"' />"; }
					$(this).parent().css({"height":"auto"}).append(getF);
					getF = "";
					$(this).hide();
					$(this).parent().append("<select id='selectType"+rCount+"["+getFString+"]["+count3+"]' name='selectType"+rCount+"["+getFString+"]["+count3+"]' style='width:25%;top:0px;height:2vw;'><option value='radio'>Buttons</option><option value='select'>Drop Menu</option><option value='text'>Text</option></select>");
						})
					});
			});
		}
		else if (value == "IF") {
		count5++;
		var AddHTML; AddHTML = "";
		$("#"+getName).append("<div id='"+menuName+"' style='float:left;'><select class='getIf'>"+inputOp+"</select></div>");
		$(".getIf").change(function(ev){
		ev.stopImmediatePropagation();
		value5 = $(this).val();
		var getV4 = parseInt(value5);
		getV4 = getV4 + 1;
		$("#"+menuName).remove();
		var ifName = "ifDiv"+count;
		console.log(menuChange);
		$("#"+getName).append("<div id='"+ifName+"' class='MultipleA'></div>");
		AddHTML = AddHTML + "<option></option>";
		jQuery.each( menuChange, function(index, value) {
		AddHTML = AddHTML + "<option name='"+value+"' value='"+value+"'>Item "+value+"</option>";
		});
		for (i = 1; i < getV4; i++) {
		$("#"+ifName).append("<div class='multiNameB'><span style='float:left;'>Button Label</span><input id='multi"+rCount+"["+rCount+"]["+i+"]' name='multi"+rCount+"["+rCount+"]["+i+"]' type='text' style='float:left; width:95%;'></div><select id='ifMenu["+rCount+"]["+i+"]' name='ifMenu["+rCount+"]["+i+"]' style='float:left;margin-right:0.5vw;'>"+AddHTML+"</select>");}
				});
			}
		});
		
		$("#addelements").on("click", function() {
			currentFormString = $("#submitform").serialize();
			$("#page1").css({"width":"0%"}); 
			$("#page2").css({"width":"100%"});
			SecondPage();
			});
}
function SecondPage() {
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
		
		function AppendColumn() {
		addformContent = currentColumnNumber;
		addformContent++;
		countAdd++;
		var piece3 = '';
		var piece1 = '<div id="'+addformContent+'" style="float:left; clear:left; width:93%; min-height:8vh; height:auto; padding-top:2vh; border-bottom:1px solid #d3d3d3;"><div style="float:left; width:14%;"><span style="font-size:1.5vw; float:left;color:#000;">'+addformContent+'. </span><textarea name="elemlabel['+addformContent+']" id="elemlabel['+addformContent+'] rows="1" cols="26" placeholder="Question" style="width:78%; float:right; height:2vw;" /></textarea></div><div style="float:left; width:10%; margin-left:0.5vw;"><select id="enterform['+addformContent+']" name="enterform['+addformContent+']" class="selectMenu""><option></option><option name="DATE" value="DATE">- DATE</option><option name="TEXTF" value="TEXTF">- TEXT FIELD</option><option name="NUMBER" value="NUMBER">- NUMBER</option>';
		var piece2 = '<option name="mChoice" value="MULTIPLE">- MULTIPLE CHOICE</option><option name="QUESTION" value="QUESTION">- QUESTIONNAIRE</option><option name="IF" value="IF">- IF STATEMENT</option></select></div><div style="float:right; width:10%;"><textarea name="taglabel['+addformContent+']" id="taglabel['+addformContent+']" rows="1" cols="26" placeholder="Element Tag" style="width:100%; float:left; height:2vw;" /></textarea></div></div>';
		piece3 = piece1+piece2;
		$("#formContent").append(piece3);
		}
				
		$("#addelements").unbind().remove();
		$("#buttonHolder").append('<button id="updateForm" id="updateForm" style="margin-right:2vw;">Update Form</button><button id="addColumnZ" id="addColumnZ" style="margin-right:2vw;">Add Columns</button>');
		$("#updateForm").on("click", AddElementF);
		$("#addColumnZ").on("click", AppendColumn);
		
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
		
		function AddElementF() {
		for (a = 0; a < countAdd; a++) {
		var addNewFH = currentColumnNumber + countAdd;
		var pContent = $('textarea[name="elemlabel['+addNewFH+']"]').val();
		var lContent = $('select[name="enterform['+addNewFH+']"]').val();
		var addFStyle = "<div id='form"+addNewFH+"' class='dragButton "+lContent+"' style='display:inline; float:right; height:auto; color:#000; background: #FFF; padding: 2px; border:2px solid #000080; font-size:26px; cursor:pointer;'><div id='menu"+addNewFH+"' class='formObject' style='display:inline; font-size:26px; background: #FFF;'>"+pContent+"</div></div><div style='clear:both; width:100%; height:1.5vh;'></div>";
		$("#presetHolder").append(addFStyle);
		$("#form"+addNewFH).draggable({
		containment: $("#form"+addNewFH).parent().parent()
		}).mousedown(function() {
		$(this).bind("drag",showOverlap); 
		$(this).bind("dragstop",showOverlap); 
		}).mouseup(function() {
		$(this).unbind("drag"); 
		$(this).unbind("dragstop"); 
		getDrop(); });
		currentColumnNumber++;
			}
		}
		
		function DragDrop() {
		$(".dragButton").draggable({containment: $(".dragButton").parent().parent()});
		$(".dragButton").mousedown(function() {	$(this).bind("drag",showOverlap); $(this).bind("dragstop",showOverlap); });
		$(".dragButton").mouseup(function(e2) {	$(this).unbind("drag"); $(this).unbind("dragstop"); getDrop(); });
		}
				
		var formData;
		$(document).ready(function() {
			$.ajax({
				type: "POST",
				url: "adm_function/storeData.php",
				data: { colCount: currentColumnNumber, category: currentCategoryName, submitform: currentFormString },
				success: function(echoData) { formData = echoData; 
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
				DragDrop(); }
				});
		});
}