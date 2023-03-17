<?php
//insert-data-artikel-verrukkulluk.php

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
    $conn->exec("INSERT INTO artikel (naam, omschrijving, prijs, eenheid, verpakking) 
    VALUES ('Eieren', 'Biologische eieren boerderij kip', '2.20', 'stuks', '6')");
    $conn->exec("INSERT INTO artikel (naam, omschrijving, prijs, eenheid, verpakking) 
    VALUES ('Melk', 'Biologische melk van boerderij leus', '1.00', 'ml', '1000')");
    $conn->exec("INSERT INTO artikel (naam, omschrijving, prijs, eenheid, verpakking) 
    VALUES ('Burger broodje', 'Brioche broodjes', '3.45', 'stuks', '6')");
    $conn->exec("INSERT INTO artikel (naam, omschrijving, prijs, eenheid, verpakking) 
    VALUES ('Mayonaise', 'Mayonaise van Calve', '2.55', 'ml', '650')");
    $conn->exec("INSERT INTO artikel (naam, omschrijving, prijs, eenheid, verpakking) 
    VALUES ('Pasta', 'Gedroogde italiaanse pasta van durum', '2.20', 'gram', '500')");
  
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