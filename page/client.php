<?php
    session_start();
?>

<!DOCTYPE html>
<HTML>
	<head>
		<meta charset="utf-8">
		<title>Vote</title>
		<link rel="stylesheet" type="text/css" href="../css/client.css">

	</head>

    <body>
        <div class="voteBox">

            <?php
                if (isset($_SESSION["passpNb"])){
                    echo " <h3> you can vote now for the passport number : </h3> ";
                    $passpNb = $_SESSION["passpNb"];
                    echo "<font color='#008000'>$passpNb</font>";
                }
            ?>

            <h1>Veuillez voter</h1>
            
            <form action="../includes/client.inc.php" method="post">
                <button class="_vote-btn" data-type="upvote" name="votea">Vote A: <span id="_upvotes">0</span></button>
                <button class="_vote-btn" data-type="downvote" name="voteb">Vote B: <span id="_downvotes">0</span></button>
                <button class="_vote-btn" data-type="downvote" name="voteblanc">Vote Blanc: <span id="_downvotes">0</span></button>
            </form>

            <?php

			if (isset($_GET["error"])) {
				if ($_GET["error"] == "nonevoteaclick") {
					echo " <p> Vous avez voter A </p> ";
				}
				else if ($_GET["error"] == "nonevotebclick"){
					echo " <p> Vous avez voter B </p> ";
				}
				else if ($_GET["error"] == "nonevoteblancclick"){
					echo " <p> Vous avez voter blanc </p> ";
				}
			}

		    ?>
        
            <a class="return" href="index.php">Retour</a>

            <script src="../js/client.js"></script>
        
        </div>

    </body>

</HTML>

