<?php
// create-table-artikel-verrukkulluk.php



$servername = "localhost";
$username = "root";
$password = "Edu-Com17";
$dbname = "verrukkulluk";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    // sql to create table
    $sql = "CREATE TABLE artikel(
    id INT(6) AUTO_INCREMENT,
    naam VARCHAR(100),
    omschrijving  VARCHAR(200),
    prijs DECIMAL(4,2),
    eenheid VARCHAR(100),
    verpakking INT,
    /* Keys*/
    PRIMARY KEY (id)
    )"; 


  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Table artikel created successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


$conn = null;
?>