<?php
session_start();
$connbd = mysqli_connect('localhost', 'mysql' , 'mysql','test');
$login = $_POST["login"];
$password = $_POST["password"];


$users = mysqli_query($connbd, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password' ");
$_SESSION['users'] = $users;
$user = mysqli_fetch_assoc($users);


$_SESSION['user'] = array('id' => $user['id'],
'login' => $user['login'],
'password' => $user['password'],
'name' => $user['name'],
'surname' => $user['surname'],
'lang' => $user['lang'],
'role' => $user['role']);


if (mysqli_num_rows($users) > 0){
    $_SESSION['login'] = $login;
    $_SESSION['password'] = $password;
    if ($user['role'] == 'admin'){
        $_SESSION['role'] = $user['role'];
        header('Location: ..\users\admin.php');
    }else if($user['role'] == 'manager'){
        $_SESSION['role'] = $user['role'];
        header('Location: ..\users\manager.php');
    }else if($user['role'] == 'client'){
        $_SESSION['role'] = $user['role'];
        header('Location: ..\users\client.php');
    }
}
