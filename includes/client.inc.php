<?php

    require_once 'dbh.inc.php';
    require 'function.inc.php';

    if(isset($_POST["votea"])){

        $vote = 'a';
        $passpNb = $_SESSION["passpNb"];
        
        vote($conn, $passpNb, $vote);
        exit();
    }
    if(isset($_POST["voteb"])){

        $vote = 'b';
        $passpNb = $_SESSION["passpNb"];

        vote($conn, $passpNb, $vote);
        exit();
    }
    if(isset($_POST["voteblanc"])){

        $vote = 'blanc';
        $passpNb = $_SESSION["passpNb"];

        vote($conn, $passpNb, $vote);
        exit();
    }

?>