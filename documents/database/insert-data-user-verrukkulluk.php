<?php
//insert-data-user-verrukkulluk.php

$servername = "localhost";
$username = "root";
$password = "Edu-Com17";
$dbname = "verrukkulluk";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    // begin the transaction
    $conn->beginTransaction();
    // our SQL statements
    $conn->exec("INSERT INTO user (user_name, password, email, afbeelding) 
    VALUES ('Kees', 'KEES1998', 'kees@example.com', 'https://www.example.com')");
    $conn->exec("INSERT INTO user (user_name, password, email, afbeelding) 
    VALUES ('Mexx', 'xxxx', 'mexx@example.com', 'https://www.example.com')");
    $conn->exec("INSERT INTO user (user_name, password, email, afbeelding) 
    VALUES ('Soraya', 'xxxxx', 'soraya@example.com', 'https://www.example.com')");
    $conn->exec("INSERT INTO user (user_name, password, email, afbeelding) 
    VALUES ('Lush', 'xxxxx', 'lush@example.com', 'https://www.example.com')");
 
  
    // commit the transaction
    $conn->commit();
    echo "New records created successfully";
  } catch(PDOException $e) {
    // roll back the transaction if something failed
    $conn->rollback();
    echo "Error: " . $e->getMessage();
  }
  
  $conn = null;
?>