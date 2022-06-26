<?php

if (isset($_POST["submit"])){
    
    $passpNb = $_POST["pnb"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdConfirm = $_POST["pwdconfirm"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($email, $passpNb, $pwd, $pwdConfirm) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (invalidpasspNb($passpNb) !== false) {
        header("location: ../signup.php?error=invalidpspnb");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd, $pwdconfirm) !== false) {
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if (passpExists($conn, $passpNb, $email) !== false) {
        header("location: ../signup.php?error=passpalreadyexist");
        exit();
    }

    createUser($conn, $passpNb, $email, $pwd);

}
else{
    header("location: ../signup.php");
    exit();
}


?>