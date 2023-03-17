<?php
// create-table-keuken-type-verrukkulluk.php
$servername = "localhost";
$username = "root";
$password = "Edu-Com17";
$dbname = "verrukkulluk";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    // sql to create table
    $sql = "CREATE TABLE keuken_type(
    id INT(6) AUTO_INCREMENT,
    record_type CHAR(1) NOT NULL,
    omschrijving  VARCHAR(30) NOT NULL,
    /* Keys*/
    PRIMARY KEY (id)
    )"; 


  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Table keuken_type created successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


$conn = null;
?>