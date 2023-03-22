<?php


class gerecht{

    private $connection;
    private $user;
    private $ingredient;
    private $keuken_type;



    public function __construct($connection) {
        $this -> connection = $connection;
        $this -> user = new  user($connection);
        $this -> ingredient = new ingredient($connection);
        $this -> keuken_type = new keukenType($connection);
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
            var_dump($type_id);
            $ingredient = $this -> selecteerIngredient($gerecht_id);
            $user = $this -> selecteerUser($user_id);
            $keuken = $this -> selecteerKeuken($keuken_id);
            $type = $this -> selecteerType($type_id);
            var_dump($type);
            var_dump($keuken);
            $keuken[] = 

            $gerechtData[] = $row + $user + 
                ["keuken" => $keuken["omschrijving"]] + 
                ["type" => $type["omschrijving"]];


        }

        return($gerechtData);
        


        
    }



}



?>