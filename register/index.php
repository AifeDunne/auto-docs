<?php
include_once '../includes/functions.php';
include_once '../includes/register.inc.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nimbus Registration</title>
        <script type="text/JavaScript" src="/Nimbus/js/sha512.js"></script> 
        <script type="text/JavaScript" src="/Nimbus/js/forms.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
		<style>
		body { font-family: 'Arimo', sans-serif; }
		</style>
    </head>
    <body>
	<div style="float:left; width:27%; margin-left:1vw; margin-top:2vw; border:5px solid #000080;padding:2vw;">
	<div style="float:left; font-size:3vw; width:100%; margin-bottom:2vw;">New Client Registration</div>
	<div style="float:left; font-size:1.5vw; width:95%;">
    Nimbus auto-document services is the most convenient way to prepare legal paperwork and proven to lift the confusion for you and, your clients. Perfect for small business owners and independent contractors involved in services requiring coverage for liability and other legal considerations.<div style="width:100%; clear:both; margin-top:3vh;"> Nimbus cuts through the red tape and was specifically designed by professionals with direct experience preparing documentation. Joining Nimbus is the first and last step for business owners looking for a solution to the common and constant headache of contracts, agreements, and more.</div>
	</div></div>
	<div style="float:left; width:60%; margin-left:1.5vw; margin-top:2vw; border:5px solid #000080;padding:2vw;">
	<div style="float:left; width:47%;">
	<div style="float:left; font-size:3vw; width:100%; margin-bottom:2vw;">Create Account</div>
	 <?php if (!empty($error_msg)) { echo $error_msg; } ?>
	    <div id="RegForm" style="width:100%; font-size:1.5vw;">
        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
			<div style="float:left; height:5vh; width:100%;"><span style="float:left;font-weight:bold;">Name: </span><input type='text' name='realname' id='realname' style="float: right; width: 16.5vw; margin-left: 2vw; height: 1.5vw;"/></div>
			<div style="float:left; height:5vh; clear:left; width:100%;"><span style="float:left;font-weight:bold;">Email: </span><input type="text" name="email" id="email" style="float: right; width: 16.5vw; margin-left: 2vw; height: 1.5vw;"/></div>
			<div style="float:left; height:5vh; clear:left; width:100%;"><span style="float:left;font-weight:bold;">Company: </span><input type="text" name="company" id="company" style="float: right; width: 16.5vw; margin-left: 2vw; height: 1.5vw;"/></div>
            <div style="float:left; height:5vh; clear:left; width:100%;"><span style="float:left;font-weight:bold;">Username: </span><input type='text' name='username' id='username' style="float: right; width:16.5vw; margin-left: 2vw; height: 1.5vw;"/></div>
            <div style="float:left; height:5vh; clear:left; width:100%;"><span style="float:left;font-weight:bold;">Password: </span><input type="password" name="password" id="password" style="float: right; width: 16.5vw; margin-left: 2vw; height: 1.5vw;"/></div>
            <div style="float:left; height:5vh; clear:left; width:100%;"><span style="float:left;font-weight:bold;">Confirm password: </span><input type="password" name="confirmpwd" id="confirmpwd" style="float: right; width: 13vw; height: 1.5vw;"/></div>
            <input type="button" value="Register" style="float:left; width: 7vw; height: 5vh; margin-bottom: 2vh; clear:left;" onclick="return regformhash(this.form, this.form.username, this.form.email, this.form.password, this.form.confirmpwd);" />
		</div>
		<div id="RegText" style="width:100%; font-size: 0.7vw; line-height: 0.7vw; clear:both;">
		<ul>
            <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
            <li>Emails must have a valid email format</li>
            <li>Passwords must be at least 6 characters long</li>
            <li>Passwords must contain
                <ul>
                    <li>At least one uppercase letter (A..Z)</li>
                    <li>At least one lower case letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
        </ul>
		</div></div>
		<div style="float:right; width:49%;">
	    <div style="float:left; font-size:3vw; width:100%; margin-bottom:2vw;">Billing Information</div>
		<div id="BillForm" style="width:100%; font-size:1.3vw;">
		<div style="float:left; height:5vh; width:100%;"><span style="float:left;font-weight:bold;">Card Number: </span><input type='text' name='cardnum' id='cardnum' style="float: right; width: 16.5vw; margin-left: 2vw; height: 1.5vw;"/></div>
		<div style="float:left; height:5vh; clear:left; width:100%;"><span style="float:left;font-weight:bold;">Confirm Account: </span><input type="text"name="confirmcard" id="confirmcard" style="float: right; width: 16.5vw; margin-left: 2vw; height: 1.5vw;"/></div>
		<div style="float:left; height:5vh; clear:left; width:100%;"><span style="float:left;font-weight:bold;">Card Holder: </span><input type="text" name="cardname" id="cardname" style="float: right; width: 16.5vw; margin-left: 2vw; height: 1.5vw;"/></div>
		<div style="float:left; height:5vh; clear:left; width:100%;"><span style="float:left;font-weight:bold;">Expiration Date: </span><input type="text" name="expdate" id="expdate" style="float: right; width: 16.5vw; margin-left: 2vw; height: 1.5vw;"/></div>
        <div style="float:left; height:5vh; clear:left; width:100%;"><span style="float:left;font-weight:bold;">Address: </span><input type="text" name="cardaddress" id="cardaddress" style="float: right; width:16.5vw; margin-left: 2vw; height: 1.5vw;"/></div>
        <div style="float:left; height:5vh; clear:left; width:100%;"><span style="float:left;font-weight:bold;">Security Code: </span><input type="text" name="cardsec" id="cardsec" style="float: right; width: 13vw; height: 1.5vw;"/></div>
		</div></div>
		</form>
		</div>
    </body>
</html>