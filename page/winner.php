<?php
    session_start();
?>

<!DOCTYPE html>
<HTML>
	<head>
		<meta charset="utf-8">
		<title>Voir le vainqueur</title>
		<link rel="stylesheet" type="text/css" href="../css/winner.css">

	</head>

	<body>
		<form class="box" action="../includes/winner.inc.php" method="post">
		
			<h1>Voir le vainqueur du vote</h1>
				
			<div align="center">
				<input type="submit" name="seewinner" value="voir le vainqueur">

		</form>

		<a href="index.php">Retour</a>


		<?php

			if (isset($_GET["error"])) {
				if ($_GET["error"] == "none") {
					echo " <p> voici le vainqueur du vote ! </p> ";
				}
			}

		?>
		
	</body>

</HTML>