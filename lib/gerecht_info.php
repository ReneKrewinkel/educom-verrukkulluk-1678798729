<?php


class gerecht_info{
    
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }
  
    public function selecteerGerechtInfo($gerecht_id) {
        $gerecht_info= [];
        $sql = "SELECT * FROM gerecht_info WHERE gerecht_id = $gerecht_id";
        
        $result = mysqli_query($this->connection, $sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $gerecht_info[] = $row;
        }

        return($gerecht_info);

    }

    public function selecteerUser($gerecht_id) {
        $sql = "SELECT user_id FROM gerecht_info WHERE gerecht_id = $gerecht_id"; 
        $result = mysqli_query($this->connection, $sql);
    }

    public function selecteerAlsFavoriet($gerecht_id){

    }

    public function verwijderFavoriet($gerecht_id){

    }



}







?>