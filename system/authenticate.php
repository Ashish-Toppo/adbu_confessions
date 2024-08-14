<?php
session_start(); 

// Redirect to home.php if the user is already logged in

if (isset($_SESSION['username']) && $_SESSION['username']!=""){
    header("Location:../src/Home.php");
    exit();
}

function validateCsrfToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}


require_once("./connection.php"); // Include your database connection credentials
require_once("./Database.php"); // Include the Database class



if (isset($_POST['login'])) {

    $csrf_token = $_POST['csrf_token'];

    if (!validateCsrfToken($csrf_token)) {
        // Handle invalid CSRF token (e.g., redirect or error message)
        header("Location: ../src/login.php?error=csrf_error");
        exit();
    }


    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new Database($conn);

    if ($db->authentication($username, $password)) {
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;

        header("Location: ../src/Home.php");
        exit();
    } else {
        header("Location: ../src/login.php?error=invalid_credentials");
        exit();
    }
}

?>
