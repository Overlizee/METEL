<?php

session_start();
session_unset();
session_destroy();

header("location: ../page/index.php");
exit();

?>