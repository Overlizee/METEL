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

function pwdMatch($pwd, $pwdconfirm){
    $result;
    if ($pwd !== $pwdconfirm) {
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
    header("location: ../signup.php?error=none");
    exit();
}