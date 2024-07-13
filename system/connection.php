<?php

/**
 * --> THis file will be used to create connection to the database
 * --> creates connection using PDO object
 * --> 
 */


//  include the database configuration file
include_once('../system/config.php');


 try {
    $conn = new PDO("mysql:host=". DBHOST .";dbname=" . DATABASE, DBUSER, DBPASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
  } catch(PDOException $e) {
    // if connection to database fails then show error message and stop furthur execution
    echo "Connection failed: " . $e->getMessage();

    die;
  }