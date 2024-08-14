<?php

session_start();

// session destroy
$_SESSION = [];



header("Location: login.php");