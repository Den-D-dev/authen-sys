<?php

// function that checks if a user is logged in
function auth_loggedIn() {
    if(!isset($_SESSION['loggedin']) && !isset($_GET['token']) && !isset($_SESSION['token'])){
        $_SESSION['error'] = "You are not authorized to view that page";
        header("location: login.php");
    }
}


function is_user_loggedIn() {
    if ($_SESSION['loggedin'] && !empty($_SESSION['loggedin'])) {
        return true;
    } else{
        return false;
    }
}

// function is_token_set() {
//     if (isset($_GET['token']) || isset($_SESSION['token'])) {
//         return true;
//     } else {
//         return faise;
//     }
// }

// refactor the refactored is_token_set

function is_token_set() {
    return is_token_set_in_get() || is_token_set_in_session();
}

function is_token_set_in_get() {
    return isset($_GET['token']);
}

function is_token_set_in_session() {
    return isset($_SESSION['token']);
}

function auth_user_logIn() {
    if(!isset($_SESSION['loggedin'])){
        header("location: login.php");
    };
}
