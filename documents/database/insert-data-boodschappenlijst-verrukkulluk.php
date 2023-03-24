<?php
//insert-data-boodschappenlijst-verrukkulluk.php

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
    $conn->exec("INSERT INTO boodschappenlijst (user_id, artikel_id, bestelAantal, ingebruik) 
    VALUES ((SELECT id FROM user WHERE user_name = 'Mexx'),
    (SELECT id FROM artikel WHERE naam = 'Burger broodje'),
    '1', '4') ");
    $conn->exec("INSERT INTO boodschappenlijst (user_id, artikel_id, bestelAantal, ingebruik) 
    VALUES ((SELECT id FROM user WHERE user_name = 'Mexx'),
    (SELECT id FROM artikel WHERE naam = 'mayonaise'),
    '1', '60') ");
    $conn->exec("INSERT INTO boodschappenlijst (user_id, artikel_id, bestelAantal, ingebruik) 
    VALUES ((SELECT id FROM user WHERE user_name = 'Mexx'),
    (SELECT id FROM artikel WHERE naam = 'eieren'),
    '1', '3') ");
    $conn->exec("INSERT INTO boodschappenlijst (user_id, artikel_id, bestelAantal, ingebruik) 
    VALUES ((SELECT id FROM user WHERE user_name = 'Mexx'),
    (SELECT id FROM artikel WHERE naam = 'melk'),
    '1', '1000') ");

  
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