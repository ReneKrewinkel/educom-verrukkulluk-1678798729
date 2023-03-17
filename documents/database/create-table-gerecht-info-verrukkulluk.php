<?php
// create-table-gerecht-info-verrukkulluk.php



$servername = "localhost";
$username = "root";
$password = "Edu-Com17";
$dbname = "verrukkulluk";




try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    // sql to create table
    $sql = "CREATE TABLE gerecht_info (
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    record_type char(1),
    gerecht_id INT,
    user_id INT,
    datum TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    nummeriekveld INT(6),
    tekstveld VARCHAR(500),
    /* Keys */
    PRIMARY KEY (id),
    FOREIGN KEY (gerecht_id) REFERENCES gerecht(id) ON DELETE SET NULL ON UPDATE CASCADE
    
      )";
  
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table gerecht info created successfully";
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
  
  $conn = null;
?>