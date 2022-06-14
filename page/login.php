<!DOCTYPE html>
<HTML>
	<head>
		<meta charset="utf-8">
		<title>Animation login form</title>
		<link rel="stylesheet" type="text/css" href="../css/login.css">

	</head>

	<body>
		<form class="box" action="index.html" method="post">
			<h1>Login</h1>

		</div>
			<input type="text" name="uid" placeholder="Username">
			<input type="Password" name="pwd" placeholder="Password">
				<p class="inscription">Je n'ai pas de <span>compte</span>. Je m'en <span>crée</span> un.</p>
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