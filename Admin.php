<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    </head>
	<?php if (login_check($mysqli) == true) : ?>
	<body>
	<div style="float:none; margin-left:auto; margin-right:auto; width:90vw; height:90vh; margin-top:5vh;">
	<div style="float:left; width:20%; height:100%; background: #000080;">
	<div style="height:10%; padding-top:5%; width:99%; border-bottom:1px white solid; text-align:center;"><a href="adm/add_cat.php" style="font-size:2vw; color:#FFF;">Add Category</a></div>
	<div style="height:10%; padding-top:5%; width:99%; border-bottom:1px white solid; text-align:center;"><a href="adm/add_preset.php" style="font-size:2vw; color:#FFF;">Add Preset</a></div>
	<div style="height:10%; padding-top:5%; width:99%; border-bottom:1px white solid; text-align:center;"><a href="adm/add_style.php" style="font-size:2vw; color:#FFF;">Add Format</a></div>
	<div style="height:10%; padding-top:5%; width:99%; border-bottom:1px white solid; text-align:center;"><a href="adm2/systemFull.php" style="font-size:2vw; color:#FFF;">New System</a></div>
	<div style="float:left; width:99%; border-bottom:1px solid white; height:10%; clear:left; text-align:center;"><a href="includes/logout.php" style="font-size:2vw; color:#FFF;">Log Out</a></div>
	</div>
	<div style="float:right; width:78%; height:100%; background: #000080;">
	<span style="float:left; font-size:3vw; color:#FFF;">Welcome Admin</span>
	</div>
	</div>
	     <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>