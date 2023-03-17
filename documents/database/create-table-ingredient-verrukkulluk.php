<?php
// create-table-ingredient-verrukkulluk.php



$servername = "localhost";
$username = "root";
$password = "Edu-Com17";
$dbname = "verrukkulluk";




try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    // sql to create table
    $sql = "CREATE TABLE ingredient(
    id INT(6) AUTO_INCREMENT,
    gerecht_id INT,
    artikel_id INT,
    aantal INT,
    /* Keys*/
    PRIMARY KEY (id),
    FOREIGN KEY (gerecht_id) REFERENCES gerecht (id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (artikel_id) REFERENCES artikel (id) ON DELETE SET NULL ON UPDATE CASCADE
    )"; 


  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Table ingredient created successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


$conn = null;
?>