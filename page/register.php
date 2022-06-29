<!DOCTYPE html>
<HTML>
	<head>
		<meta charset="utf-8">
		<title>Register form</title>
		<link rel="stylesheet" type="text/css" href="../css/login.css">

	</head>

	<body>
		<form class="box" action="../includes/register.inc.php" method="post">
			<h1>S'enregistrer</h1>

			</div>
				<input type="text" name="email" placeholder="Email">
				<input type="text" name="pnb" placeholder="Passport Number">
				<input type="Password" name="pwd" placeholder="Password">
				<input type="Password" name="pwdconfirm" placeholder="Confirm Password">
				
			<div align="center">

			<input type="submit" name="submit" value="Créer mon compte">

			<?php

				if (isset($_GET["error"])) {
					if ($_GET["error"] == "emptyinput") {
						echo " <p> Fill in all fields </p> ";
					}
					else if ($_GET["error"] == "invaliduid"){
						echo " <p> Choose another username </p> ";
					}
					else if ($_GET["error"] == "invalidemail"){
						echo " <p> Choose a proper email </p> ";
					}
					else if ($_GET["error"] == "passwordsdontmatch"){
						echo " <p> Passwords doesn't match </p> ";
					}
					else if ($_GET["error"] == "stmtfailed"){
						echo " <p> Something went wrong, try again </p> ";
					}
					else if ($_GET["error"] == "passpalreadyexist"){
						echo " <p> Passport already exist, choose another </p> ";
					}
					else if ($_GET["error"] == "none"){
						echo " <p> You have signed up ! </p> ";
					}
				}

			?>

		</form>

        <a href="index.html">Retour</a>
		
	</body>

</HTML>