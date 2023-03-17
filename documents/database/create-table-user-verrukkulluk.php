<?php
// create-table-user-verrukkulluk.php



$servername = "localhost";
$username = "root";
$password = "Edu-Com17";
$dbname = "verrukkulluk";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    // sql to create table
    $sql = "CREATE TABLE user(
    id INT(6) AUTO_INCREMENT, 
    user_name VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    afbeelding VARCHAR(200),
    /* Keys */
    PRIMARY KEY (id)
      )";
  
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table user created successfully";
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }

  
$conn = null;

?>
