<?php
session_start();
require_once 'includes/validation.php';

$email = $_POST['email'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$remember = isset($_POST['remember']);

$u_valid = validateUsername($username);
$e_valid = validateEmail($email);
$p_valid = validatePassword($password);

if ($u_valid !== true || $e_valid !== true || $p_valid !== true) {
    $_SESSION['error'] = "Validation Failed: Please check your inputs.";
    header("Location: login.php");
    exit();
}

$isAuthenticated = false;
$assigned_theme = 'light'; 

if ($username === 'admin' && $email === 'admin@gmail.com' && $password === 'Admin@123') {
    $isAuthenticated = true;
    $assigned_theme = 'light';
} elseif ($username === 'user1' && $email === 'user1@gmail.com' && $password === 'User1@123') {
    $isAuthenticated = true;
    $assigned_theme = 'dark';
} elseif ($username === 'user2' && $email === 'user2@gmail.com' && $password === 'User2@123') {
    $isAuthenticated = true;
    $assigned_theme = 'warm';
}

if ($isAuthenticated) {

    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['theme'] = $assigned_theme;

    if ($remember) {  //remember box checked
        
        setcookie("remember_username", $username, time() + 60, "/");
        setcookie("user_theme", $assigned_theme, time() + 60, "/");
    } else {
       
        if (isset($_COOKIE['remember_username'])) {
            setcookie("remember_username", "", time() - 3600, "/");
        }

        setcookie("user_theme", $assigned_theme, time() + 60, "/"); 
    }


    header("Location: dashboard.php");
    exit();

} else {
    
    $_SESSION['error'] = "Invalid credentials. Try 'user1', 'user2', or 'admin'.";
    header("Location: login.php");
    exit();
}
?>