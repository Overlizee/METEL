<?php

if (isset($_POST["submit"])){

    $passpNb = $_POST["pnb"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdConfirm = $_POST["pwdconfirm"];

    require_once 'dbh.inc.php';
    require_once 'function.inc.php';


    if (emptyInputSignup($email, $passpNb, $pwd, $pwdConfirm) !== false) {
        header("location: ../page/register.php?error=emptyinput");
        exit();
    }
    if (invalidpasspNb($passpNb) !== false) {
        header("location: ../page/register.php?error=invalidpspnb");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../page/register.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd, $pwdConfirm) !== false) {
        header("location: ../page/register.php?error=passwordsdontmatch");
        exit();
    }
    if (passpExists($conn, $passpNb, $email) !== false) {
        header("location: ../page/register.php?error=passpalreadyexist");
        exit();
    }

    createUser($conn, $passpNb, $email, $pwd);

}
else{
    header("location: ../page/register.php");
    exit();
}


?>