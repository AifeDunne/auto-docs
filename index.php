<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
if (login_check($mysqli) == true) { $logged = 'in';
} else { $logged = 'out'; }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nimbus Login</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
		<style>
		body { font-family: 'Arimo', sans-serif; }
		</style>
    </head>
    <body>
	<div style="float:left; width:30%; margin-left:2vw; margin-top:5vw; border:5px solid #000080;padding:2vw;">
	<div style="float:left; font-size:3vw; width:100%; margin-bottom:2vw;">Client Login</div>
	<div style="float:left; font-size:1.5vw; width:80%;">
        <?php
        if (isset($_GET['error'])) { echo '<p class="error">Error Logging In!</p>'; }
        ?> 
        <form action="includes/process_login.php" method="post" name="login_form">
            <span style="float:left;font-weight:bold;">Email: </span><input type="text" name="email"  style="float:right;width:13vw;margin-right:2vw;"/>
			<div style="clear:both;"></div>
            <span style="float:left;font-weight:bold;">Password: </span><input type="password" name="password" id="password" style="float:right;  width: 13vw; margin-right:2vw;"/>
			<div style="clear:both;"></div>
            <input type="button" value="Login" style="width: 7vw; height: 5vh; margin-top: 2vh;" onclick="formhash(this.form, this.form.password);" /> 
        </form>
		<?php
        if (login_check($mysqli) == true) {
            echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
        } else {  echo '<p>Currently logged ' . $logged . '.</p>'; }
		?>
	</div></div>
	<div style="float:right; width:40%; margin-right:10vw; margin-top:5vw; border:5px solid #000080;padding:2vw;">
	<div style="float:left; font-size:3vw; width:100%; margin-bottom:2vw;">New Client?</div>
	<div style="float:left; font-size:1.6vw; width:80%;">Join <b>Nimbus Cloud Services</b> today: <a href="register/" style="color:blue; text-decoration:underline;">Register</a></div>
	</div></div>
    </body>
</html>