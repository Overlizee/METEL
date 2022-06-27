<?php

    if(isset($_POST["submit"])) {

        $passpNb = $_POST["pnb"];
        $pwd = $_POST["pwd"];

        require_once 'dbh.inc.php';
        require 'function.inc.php';


        if (emptyInputLogin($passpNb, $pwd) !== false) {
            header("location: ../page/login.php?error=emptyinput");
            exit();
        }

        loginUser($conn, $passpNb, $pwd);
    }

    else{
        header("location: ../page/login.php");
        exit();
    }

?>



