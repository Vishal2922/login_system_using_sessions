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
    $_SESSION['error'] = "Validation Failed: Check input format.";
    header("Location: login.php");
    exit();
}

$users_db = [
    'admin' => ['email' => 'admin@gmail.com', 'password' => 'Pass@123', 'theme' => 'light'],
    'user1' => ['email' => 'user1@gmail.com', 'password' => 'User1@123', 'theme' => 'dark'],
    'user2' => ['email' => 'user2@gmail.com', 'password' => 'Pass@123', 'theme' => 'warm']
];

if (array_key_exists($username, $users_db)) {
    $stored_user = $users_db[$username];

    if ($email === $stored_user['email']) {
        if ($password === $stored_user['password']) {

            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['theme'] = $stored_user['theme'];

            if (stripos($password, $username) !== false) {
                $_SESSION['warning'] = "Security Alert: Your password contains your username. We strongly recommend changing it!";
            }

            if ($remember) {
                setcookie("remember_username", $username, time() + 3600, "/");
                setcookie("user_theme", $stored_user['theme'], time() + 3600, "/");
            } else {
                if (isset($_COOKIE['remember_username'])) {
                    setcookie("remember_username", "", time() - 3600, "/");
                }
                setcookie("user_theme", $stored_user['theme'], time() + 3600, "/");
            }

            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Incorrect Password!";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Incorrect Email!";
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Username not found!";
    header("Location: login.php");
    exit();
}
