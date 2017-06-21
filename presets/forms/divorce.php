<?php

$compileForm = '<div style="float:none; margin-left:auto; margin-right:auto; width:75vw; height:80vh; margin-top:10vh; background: #000080; color:#FFF;">
<div style="float:left; width:100%; font-size:1vw;"><span style="font-size:2vw; font-weight:bold;">PETITIONER</span><br>
	<span style="float:left;">NAME</span><div style="float:left; margin-left:2vw;"><input name="firstname" id="firstname" type="text" placeholder="First Name" style="float:left; width:20%; margin-right:1vw;" /><input name="middlename" id="middlename" type="text" placeholder="Middle Name" style="float:left; width:20%; margin-right:1vw;" /><input name="lastname" id="lastname" type="text" placeholder="Last Name" style="float:left; width:20%;" /></div>
</div>

<div style="float:left; width:100%; font-size:1vw; margin-top:0.5vw; clear:left;"><span style="float:left; margin-right:2vw;">SEX</span><label for="male" style="float:left;">Male</label><input type="radio" name="sex" id="male" value="male" style="float:left; margin-right:2vw;"><label for="female" style="float:left;">Female</label><input type="radio" name="sex" id="female" value="female"></div>

<div style="float:left; width:100%; font-size:1vw; margin-top:0.5vw; clear:left;"><span style="float:left;">DATE OF BIRTH: </span><input name="dob" id="dob" type="text" placeholder="xx/xx/xxxx" style="float:left; width:5%; margin-left:1vw;" /></div>

<div style="float:left; width:100%; font-size:1vw; margin-top:0.5vw; clear:left;"><span style="float:left;">SOCIAL SECURITY NUMBER: </span><input name="ssn" id="ssn" type="text" placeholder="000-00-0000" style="float:left; width:10%; margin-left:1vw;" /></div>

<div style="float:left; width:100%; font-size:1vw; margin-top:1.5vw; clear:left;"><span style="float:left;">ADDRESS: </span><input name="address" id="address" type="text" placeholder="0000 West Street, New York, NY" style="float:left; width:40%; margin-left:1vw;" /></div>
<div style="float:left; width:100%; font-size:1vw; margin-top:0.5vw; clear:left;"><span style="float:left;">PHONE NUMBER: </span><input name="phone" id="phone" type="text" placeholder="777-7777" style="float:left; width:30%; margin-left:1vw;" /></div>

<div style="float:left; width:100%; font-size:1vw; margin-top:0.5vw; clear:left;"><span style="float:left; padding-right:2vw;">MARITAL STATUS: </span><label for="single" style="float:left;">SINGLE</label><input type="radio" name="mstatus" id="single" value="single" style="float:left; margin-right:2vw;"><label for="married" style="float:left;">MARRIED</label><input type="radio" name="mstatus" id="married" value="married" style="float:left; margin-right:2vw;"><label for="separated" style="float:left;">LEGALLY SEPARATED</label><input type="radio" name="mstatus" id="separated" value="separated" style="float:left; margin-right:2vw;"><label for="widow" style="float:left;">WIDOW (if female)</label><input type="radio" name="mstatus" id="widow" value="widow" style="float:left; margin-right:2vw;"><label for="widower" style="float:left;">WIDOWER (if male)</label><input type="radio" name="mstatus" id="widower" value="widower" style="float:left; margin-right:2vw;"></div>

<div style="float:left; width:100%; font-size:1vw; margin-top:1.5vw; clear:left;"><span style="float:left;">EMPLOYER: </span><input name="employer" id="employer" type="text" style="float:left; width:40%; margin-left:1vw;" /></div>
<div style="float:left; width:100%; font-size:1vw; margin-top:0.5vw; clear:left;"><span style="float:left;">EMPLOYER ADDRESS: </span><input name="employeradd" id="employeradd" type="text" style="float:left; width:40%; margin-left:1vw;" /></div>
<div style="float:left; width:100%; font-size:1vw; margin-top:0.5vw; clear:left;"><span style="float:left;">EMPLOYER PHONE NUMBER: </span><input name="employerphone" id="employerphone" type="text" style="float:left; width:30%; margin-left:1vw;" /></div>
<div style="float:left; width:100%; font-size:1vw; margin-top:0.5vw; clear:left;"><span style="float:left;">GROSS MONTHLY INCOME: </span><input name="employerphone" id="employerphone" type="text" style="float:left; width:20%; margin-left:1vw;" /></div>
</div>';

echo $compileForm;

?>