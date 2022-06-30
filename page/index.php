<?php
    session_start();
?>
<!DOCTYPE html>
<HTML>
	<head>
		<meta charset="utf-8">
		<title>index</title>
		<link rel="stylesheet" type="text/css" href="../css/index.css">

	</head>

    <body>

        <div class="nav">
            <input type="checkbox" id="nav-check">
            <div class="nav-header">
            <div class="nav-title">
                VOTE A DISTANCE

            <?php
                if ((isset($_SESSION["passpNb"])) && ($_SESSION["usersType"]=='votant')){
                    echo "<h3> Bonjour " . $_SESSION["passpNb"] . "</h3>";
                }
                else if((isset($_SESSION["passpNb"])) && ($_SESSION["usersType"]=='admin')){
                    echo "<h3> Bonjour " . $_SESSION["passpNb"] . " (ADMIN) </h3>";
                }
            ?>
            
            </div>
                <h2>Veuillez faire un choix</h2>
            </div>
            <div class="nav-btn">
            <label for="nav-check">
                <span></span>
                <span></span>
                <span></span>
            </label>
            </div>
            
            <div class="nav-links">
                <a href="login.php">S'identifier</a>
                <a href="register.php">S'enregistrer</a>
                <a href="../includes/logout.inc.php">Se déconnecter</a>
                <?php
                    if (isset($_SESSION["passpNb"])){
                        echo "<a href='client.php'>Voter</a>";
                    }
                    else{
                        echo"<a class='long' href=''>Vous devez être identifier pour voter</a>";
                    }

                    if((isset($_SESSION["passpNb"])) && ($_SESSION["usersType"]=='admin')){
                        echo "<a href='winner.php'>voir le candidat vainqeur</a>";
                    }
                ?>
            </div>
        </div>

    </body>
</HTML>