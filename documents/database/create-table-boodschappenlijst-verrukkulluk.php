<?php
// create-table-boodschappenlijst-verrukkulluk.php



$servername = "localhost";
$username = "root";
$password = "Edu-Com17";
$dbname = "verrukkulluk";


try { 
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    // sql to create table
    $sql = "CREATE TABLE boodschappenlijst (
        id INT(6) AUTO_INCREMENT,
        user_id INT(6),
        artikel_id INT(6),
        bestelAantal VARCHAR(255),
        ingebruik VARCHAR(255),
        
        /* KEYS */
        PRIMARY KEY (id),
        FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE SET NULL ON UPDATE CASCADE,
        FOREIGN KEY (artikel_id) REFERENCES artikel(id) ON DELETE SET NULL ON UPDATE CASCADE
        )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table user created successfully";
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }



  $conn = null;
?>