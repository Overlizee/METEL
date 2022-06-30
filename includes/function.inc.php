<?php

session_start();

function emptyInputSignup($email, $passpNb, $pwd, $pwdConfirm) {
    $result;
    if (empty($email) || empty($passpNb) || empty($pwd) || empty($pwdConfirm)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidpasspNb($passpNb) {
    $result;
    if (!preg_match("/^[A-Z0-9]*$/", $passpNb)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdConfirm){
    $result;
    if ($pwd !== $pwdConfirm) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function passpExists($conn, $passpNb, $email){
    $sql = "SELECT * FROM users WHERE usersPasspNb = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $passpNb, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $passpNb, $email, $pwd){
    $sql = "INSERT INTO users (usersPasspNb, usersEmail, usersPwd, usersType) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $usersType = "votant";
    $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $passpNb, $email, $hashPwd, $usersType);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../page/register.php?error=none");
    exit();
}

function emptyInputLogin($passpNb, $pwd){
    $result;
    if (empty($passpNb) || empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function uidExists($conn, $passpNb){
    $sql = "SELECT * FROM users WHERE usersPasspNb = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $passpNb);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function loginUser($conn, $passpNb, $pwd){
    $uidExists = uidExists($conn, $passpNb);

    if($uidExists == false){
        header("location: ../page/login.php?error=wrongpasspNb");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd == false) {
        header("location: ../page/login.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd == true) {
        //session_start();
        $_SESSION["passpNb"] = $uidExists["usersPasspNb"];
        $_SESSION["usersType"] = $uidExists["usersType"];
        header("location: ../page/client.php");
        exit();
    }

}

function vote($conn, $passpNb, $vote){

    $hashVote = password_hash($vote, PASSWORD_DEFAULT);

    $sql = "UPDATE `users` SET `vote` = '$hashVote' WHERE `users`.`usersPasspNb` = '$passpNb';";

    $query_run = mysqli_query($conn, $sql);

    if(($query_run) && ($vote=='a')){
        header("location: ../page/client.php?error=nonevoteaclick");
        exit();
    }
    else if(($query_run) && ($vote=='b')){
        header("location: ../page/client.php?error=nonevotebclick");
        exit();
    }
    else if(($query_run) && ($vote=='blanc')){
        header("location: ../page/client.php?error=nonevoteblancclick");
        exit();
    }
    else{
        header("location: ../page/client.php?error=notupdated");
        exit();
    }

    exit();
}

/*function winner($conn){

    $hashVote = 
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd == false) {
        header("location: ../page/login.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd == true) {
        //session_start();
        $_SESSION["passpNb"] = $uidExists["usersPasspNb"];
        $_SESSION["usersType"] = $uidExists["usersType"];
        header("location: ../page/client.php");
        exit();
    }
    
}*/
