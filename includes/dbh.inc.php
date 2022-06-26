<?php

    $serverName = "localhost:3306";
    $dBUserName = "id17952698_user";
    $dBPassword = "dm=0Cdgw|PLuR3ij";
    $dBName = "id17952698_remotevote";

    $conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

    if (!$conn){
        die("connection failed : " . mysqli_connect_error());
    }

?>

