<?php
//insert-data-gerecht-info-verrukkulluk.php

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
    $conn->exec("INSERT INTO gerecht_info (record_type, gerecht_id, nummeriekveld, tekstveld) 
    VALUES ('B',
    (SELECT id FROM gerecht WHERE titel = 'Vegan burger'),
     '1' ,'Bereiding stap 1')");
    $conn->exec("INSERT INTO gerecht_info (record_type, gerecht_id, nummeriekveld, tekstveld) 
    VALUES ('B',
    (SELECT id FROM gerecht WHERE titel = 'Vegan burger'),
     '2' ,'Bereiding stap 2')");
    $conn->exec("INSERT INTO gerecht_info (record_type, gerecht_id, nummeriekveld, tekstveld) 
    VALUES ('B',
    (SELECT id FROM gerecht WHERE titel = 'Vegan burger'),
     '3' ,'Bereiding stap 3')");
    $conn->exec("INSERT INTO gerecht_info (record_type, gerecht_id, nummeriekveld, tekstveld) 
    VALUES ('B',
    (SELECT id FROM gerecht WHERE titel = 'Vegan burger'),
     '4' ,'Bereiding stap 4')");
    $conn->exec("INSERT INTO gerecht_info (record_type, gerecht_id, user_id, tekstveld) 
    VALUES ('O',
    (SELECT id FROM gerecht WHERE titel = 'Vegan burger'),
     '1' ,'Super lekker!')");
    $conn->exec("INSERT INTO gerecht_info (record_type, gerecht_id, user_id,  tekstveld) 
    VALUES ('O',
    (SELECT id FROM gerecht WHERE titel = 'Lasagne'),
     '2' ,'Te moeilijk!')");
    $conn->exec("INSERT INTO gerecht_info (record_type, gerecht_id, user_id) 
    VALUES ('F',
    (SELECT id FROM gerecht WHERE titel = 'Vegan burger'),
     '2')");
    $conn->exec("INSERT INTO gerecht_info (record_type, gerecht_id, user_id) 
    VALUES ('F',
    (SELECT id FROM gerecht WHERE titel = 'Sushi rolls'),
     '1')");
   


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