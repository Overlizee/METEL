<?php

    $serverName = "https://databases.000webhost.com/?_ga=2.102553025.1336437071.1655192136-1081842297.1655192136";
    $dBUserName = "id17952698_user";
    $dBPassword = "dm=0Cdgw|PLuR3ij";
    $dBName = "id17952698_remotevote";

    $conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

    if (!$conn){
        die("connection failed : " . mysqli_connect_error());
    }

?>

