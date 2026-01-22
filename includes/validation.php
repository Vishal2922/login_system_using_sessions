<?php

function validateUsername($username) {

    if (empty($username) || !ctype_alnum($username)) {
        return "Invalid username. Only letters and numbers allowed.";
    }
    return true;
}

function validateEmail($email) {
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }
    return true;
}

function validatePassword($password) {
    
    if (strlen($password) < 6) {
        return "Password must be at least 6 characters long.";
    }
    return true;
}
?>