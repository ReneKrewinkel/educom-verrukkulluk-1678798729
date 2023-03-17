<?php
//insert-data-ingredient-verrukkulluk.php

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
    $conn->exec("INSERT INTO ingredient (gerecht_id, artikel_id, aantal) 
    VALUES ((SELECT id FROM gerecht WHERE titel = 'Vegan burger'),
    (SELECT id FROM artikel WHERE naam = 'Burger broodje'),
    '4') ");
    $conn->exec("INSERT INTO ingredient (gerecht_id, artikel_id, aantal) 
    VALUES ((SELECT id FROM gerecht WHERE titel = 'Vegan burger'),
    (SELECT id FROM artikel WHERE naam = 'Mayonaise'),
    '60') ");
    $conn->exec("INSERT INTO ingredient (gerecht_id, artikel_id, aantal) 
    VALUES ((SELECT id FROM gerecht WHERE titel = 'Lasagne'),
    (SELECT id FROM artikel WHERE naam = 'pasta'),
    '250') ");
    $conn->exec("INSERT INTO ingredient (gerecht_id, artikel_id, aantal) 
    VALUES ((SELECT id FROM gerecht WHERE titel = 'Lasagne'),
    (SELECT id FROM artikel WHERE naam = 'melk'),
    '1000') ");
  
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