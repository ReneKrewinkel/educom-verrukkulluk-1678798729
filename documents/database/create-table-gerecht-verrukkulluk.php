<?php
// create-table-gerecht-verrukkulluk.php


$servername = "localhost";
$username = "root";
$password = "Edu-Com17";
$dbname = "verrukkulluk";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // sql to create table
  $sql = "CREATE TABLE gerecht (
  id INT(6) AUTO_INCREMENT, 
  keuken_id INT,
  type_id INT,
  user_id INT,
  titel VARCHAR(75) NOT NULL,
  korte_omschrijving VARCHAR(500) NOT NULL,
  lange_omschrijving VARCHAR(1000) NOT NULL,
  afbeelding VARCHAR(250),
  datum_toegevoegd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  /* Keys */
  PRIMARY KEY (id),
  FOREIGN KEY (keuken_id) REFERENCES keuken_type(id) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (type_id) REFERENCES keuken_type(id) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE SET NULL ON UPDATE CASCADE
    )";

  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Table gerecht created successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>