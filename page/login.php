<!DOCTYPE html>
<HTML>
	<head>
		<meta charset="utf-8">
		<title>Animation login form</title>
		<link rel="stylesheet" type="text/css" href="../css/login.css">

	</head>

	<body>
		<form class="box" action="../includes/login.inc.php" method="post">
			<h1>Login</h1>

		</div>
			<input type="text" name="pnb" placeholder="Passport Number">
			<input type="Password" name="pwd" placeholder="Password">
			
		<div align="center">
			<input type="submit" name="submit" value="Connecting">

		</form>


		<?php

			if (isset($_GET["error"])) {
				if ($_GET["error"] == "emptyinput") {
					echo " <p> Fill in all fields </p> ";
				}
				else if ($_GET["error"] == "wronglogin"){
					echo " <p> Wrong login ! </p> ";
				}
			}

		?>
		
	</body>

</HTML>