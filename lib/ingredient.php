<?php

class ingredient{
    
    private $art;
    private $connection;

    public function __construct($connection) {
        $this -> connection = $connection;
        $this -> art = new artikel($connection);
    }

    private function kiesArtikel($artikel_id){
        $artikelData = $this-> art-> selecteerArtikel($artikel_id);
        return ($artikelData);
    }

    public function selecteerIngredient($gerecht_id) {
        
        $ingredienten = [];
        $sql = "SELECT * FROM ingredient WHERE gerecht_id = $gerecht_id";
        
        // echo "$gerecht_id <br>";
        $result = mysqli_query($this->connection, $sql);
        // $ingredient = mysqli_fetch_array($result, MYSQLI_ASSOC); 

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { // mysql_fetch_array() returns false when no more rows are available --> no looping increment needed
            // var_dump($row);
            // echo "<br>";
            $artikel_id = $row["artikel_id"];
            $artikel =  $this -> kiesArtikel($artikel_id);

            $ingredienten[] = [
                "id" => $row["id"],
                "gerecht_id" => $row["gerecht_id"],
                "artikel_id" => $row["artikel_id"],
                "aantal" => $row["aantal"],
                "naam" => $artikel["naam"],
                "omschrijving" => $artikel["omschrijving"],
                "prijs" => $artikel["prijs"],
                "eenheid" => $artikel["eenheid"],
                "verpakking" => $artikel ["verpakking"],
                "kcal" => $artikel["kcal"],
                "afbeelding" => $artikel["afbeelding"]
            ];
            

        }
        
        return ($ingredienten);
        
    }
}
