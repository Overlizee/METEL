<?php

    if(isset($_POST["seewinner"])) {

        require_once 'dbh.inc.php';
        require 'function.inc.php';
        echo 'test win';
        //winner($conn);
    }

    else{
        header("location: ../page/login.php");
        exit();
    }

?>