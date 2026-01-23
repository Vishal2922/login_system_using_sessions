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
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }

    if (!preg_match('/[A-Z]/', $password)) {
        return "Password must contain at least one Uppercase letter (A-Z).";
    }

    if (!preg_match('/[a-z]/', $password)) {
        return "Password must contain at least one Lowercase letter (a-z).";
    }

    if (!preg_match('/[0-9]/', $password)) {
        return "Password must contain at least one Number (0-9).";
    }

    if (!preg_match('/[\W_]/', $password)) {
        return "Password must contain at least one Special Character (e.g., @, #, $).";
    }

    return true;
}
?>