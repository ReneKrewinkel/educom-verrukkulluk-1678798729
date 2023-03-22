<?php


class gerecht{

    // private $connection;
    // private $user;
    // private $ingredient;
    // private $keuken_type;
    // private $gerecht_info;



    public function __construct($connection) {
        $this -> connection = $connection;
        $this -> user = new  user($connection);
        $this -> ingredient = new ingredient($connection);
        $this -> keuken_type = new keukenType($connection);
        $this -> gerecht_info = new gerecht_info($connection);
    }

    private function selecteerUser($user_id){
        $userData = $this -> user -> selecteerUser($user_id);
        return ($userData);
    }

    private function selecteerIngredient($gerecht_id){
        $ingredientData = $this -> ingredient -> selecteerIngredient($gerecht_id);
        return ($ingredientData);
    }

    private function selecteerkeuken($keuken_id){
        $keuken = $this -> keuken_type -> selecteerKeukenType($keuken_id);
        return($keuken);
    }

    private function selecteerType($type_id){
        $type = $this -> keuken_type -> selecteerKeukenType($type_id);
        return ($type);
    }

    public function favoriet($gerecht_id, $user_id){
        $favoriet = FALSE;
        $gerecht_info = $this -> gerecht_info -> selecteerGerechtInfo($gerecht_id);
        foreach($gerecht_info as $item) {
            if ($item["record_type"] === "F"){
                echo "<pre>";
                var_dump($item);
                echo "</pre>";
                if ($item["user_id"] == $user_id){
                    echo "true1";
                    $favoriet = TRUE;
                return $favoriet;
                }
            }
        }
        return $favoriet;
        }




    public function selecteerRecept($gerecht_id) {
        // $gerechten = [];
        $gerechtData = [];
        $sql = " SELECT * FROM gerecht WHERE id = $gerecht_id";

        $result = mysqli_query($this -> connection, $sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $gerecht_id = $row['id'];
            $user_id = $row['user_id'];
            $keuken_id = $row['keuken_id'];
            $type_id = $row['type_id'];
            $ingredient = $this -> selecteerIngredient($gerecht_id);
            $user = $this -> selecteerUser($user_id);
            $keuken = $this -> selecteerKeuken($keuken_id);
            $type = $this -> selecteerType($type_id);
            // var_dump($type);
            // var_dump($keuken);
            // echo "<br><br><br><br>";
            // var_dump($ingredient);
            // echo "<br><br><br><br>";

            $gerechtData[] = $row + $user + $ingredient +
                ["keuken" => $keuken["omschrijving"]] + 
                ["type" => $type["omschrijving"]];


        }

        return($gerechtData);
                }







    public function berekenPrijs($gerecht_id){
        $prijsData=[];
        (float)$totaalPrijs = 0;
        $ingredientData = $this -> selecteerIngredient($gerecht_id);

        foreach ($ingredientData as $prijs) {
            $prijsData[] = $prijs["prijs"];
        }
        
        foreach ($prijsData as $prijs) {
            (float)$prijs;
            $totaalPrijs = $totaalPrijs + $prijs;
        }
        return($totaalPrijs);

    }

}







?>