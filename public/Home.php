<?php
session_start();

    // if the user is not signed in then redirect ot index page so the user can sign in
    if ( !isset($_SESSION['username']) ) header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <style>
        button{
            top:50%;
            background-color:#0a0a23;
            color: #fff;
            border:none; 
            border-radius:10px; 
            padding:15px;
            min-height:30px; 
            min-width: 120px;
           
        }
        a{
            color:white;
            text-decoration:none;

        }
    </style>

</head>
<body>
    <h1>HOME PAGE<h1>
    <button><a href="logout.php">Sign Out</a></button>

    
</body>
</html>