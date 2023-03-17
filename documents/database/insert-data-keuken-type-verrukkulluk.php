<?php
//insert-data-keuken-type-verrukkulluk.php

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
    $conn->exec("INSERT INTO keuken_type (record_type, omschrijving) 
    VALUES ('K', 'Amerikaans')");
    $conn->exec("INSERT INTO keuken_type (record_type, omschrijving) 
    VALUES ('K', 'Chinees')");
    $conn->exec("INSERT INTO keuken_type (record_type, omschrijving)  
    VALUES ('T', 'Vlees')");
    $conn->exec("INSERT INTO keuken_type (record_type, omschrijving)  
    VALUES ('K', 'Japans')");
    $conn->exec("INSERT INTO keuken_type (record_type, omschrijving)  
    VALUES ('T', 'Vega')");
    $conn->exec("INSERT INTO keuken_type (record_type, omschrijving)  
    VALUES ('T', 'Vis')");
    $conn->exec("INSERT INTO keuken_type (record_type, omschrijving)  
    VALUES ('T', 'Pasta')");
    $conn->exec("INSERT INTO keuken_type (record_type, omschrijving)  
    VALUES ('K', 'Italiaans')");
  
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