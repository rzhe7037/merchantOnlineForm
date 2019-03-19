<?php

include_once('../../config/Database.php');
session_start();

$database = new Database();
$conn = $database->connect();

$username = $_POST['username'];
$password = $_POST['password'];

if(empty($username) || empty($password)){
    header('Location: /ShopInfo/pages/login.php'.'?msg=login_incomplete');
    exit();
}

$query = 'SELECT * FROM users WHERE username = :username AND password = :password;';
$stmt = $conn->prepare($query);
$stmt->bindParam(':username',$username);
$stmt->bindParam(':password',md5($password));
$stmt->execute();
$num = $stmt->rowCount();

// pass verify
if($num > 0){
    $_SESSION['username'] = $username;
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['privilege'] = $result['privilege'];
    header('Location: ../main.php');
    exit();
}


header('Location: /ShopInfo/pages/login.php'.'?msg=login_fail');