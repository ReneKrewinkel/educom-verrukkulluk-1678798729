<?php


class zoeken {

    private $connection;

    public function __construct($connection) {
        $this -> connection = $connection;
    }

    public function zoekopdracht($searchTerm){
        $searchTerm = $this->connection->real_escape_string($searchTerm);

        $sql = "SELECT * FROM gerecht WHERE titel LIKE '%$searchTerm%+'";
        $result = mysqli_query($this->connection, $sql);
        
        // Check for errors
        if (!$result) {
            die("Error executing query: " . $this->conn->error);
        }
        


        $zoekdata = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $zoekdata[] = $row; 
        }

       
        // header('Content-Type: application/json');
        echo json_encode($zoekdata);
    }   
}

require_once("database.php");
$db = new database();
$handler = new zoeken($db -> getConnection());

if (isset($_POST['searchTerm'])) {
    $handler->zoekopdracht($_POST['searchTerm']);
}

?>