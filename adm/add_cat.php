<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Category</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    </head>
	<?php if (login_check($mysqli) == true) : ?>
	<body>
	<div style="width:85vw; float:none; margin-left:auto; margin-right:auto; height:70vh; margin-top:15vh; background: #000080;"><div style="float:left; height:10vh; width:100%; border-bottom:1px solid white;"><div style="width:20%; float:left; height:100%;"><a href="/Nimbus/Admin.php" style="font-size:2vw; color:#FFF;">Home</a></div></div>
	<div style="float:left; height:60vh; width:100%; clear:left;">
		<div style="float:none; width:70%; margin-left:auto; margin-right:auto; height:60%; margin-top:8vh; border:1px solid white;">
			<div style="float:left; width:95%; margin-left:3%; height:20vh;">
			<span style="font-size:1.5vw; float:left; color:#FFF;">Add Preset Category</span><form id="entercat" name="entercat" method="POST" action="adm_function/updatecategory.php"><button name="submitcat" id="submitcat" type="submit" form="entercat" style="width:5vh; height:5vh; float:right; font-weight:bold;">+</button><input name="addgroup" id="addgroup" type="text" placeholder="Group Name" style="width:32%; float:right; margin-left:3%; height:4.3vh;" /><input name="addcat" id="addcat" type="text" placeholder="Category Title" style="width:32%; float:right; height:4.3vh;" /></form>
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