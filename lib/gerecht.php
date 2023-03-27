<?php


class gerecht{

    private $connection;
    private $user;
    private $ingredient;
    private $keuken_type;
    private $gerecht_info;


// Initialisatie
    public function __construct($connection) {
        $this -> connection = $connection;
        $this -> user = new  user($connection);
        $this -> ingredient = new ingredient($connection);
        $this -> keuken_type = new keukenType($connection);
        $this -> gerecht_info = new gerecht_info($connection);
    }

// Data ophalen
    private function selecteerUser($user_id){
        $userData = $this -> user -> selecteerUser($user_id);
        return ($userData);
    }

    private function selecteerIngredient($gerecht_id){
        $ingredientData = $this -> ingredient -> selecteerIngredient($gerecht_id);
        return ($ingredientData);
    }

    private function selecteerKeuken($keuken_id){
        $keuken = $this -> keuken_type -> selecteerKeukenType($keuken_id);
        return($keuken);
    }

    private function selecteerType($type_id){
        $type = $this -> keuken_type -> selecteerKeukenType($type_id);
        return ($type);
    }

    private function selecteerFavoriet($gerecht_id){
        $favorieten = [];
        $favorietData = $this -> gerecht_info -> selecteerGerechtInfo($gerecht_id);
        foreach($favorietData as $row) {
            if ($row["record_type"] === "F"){
               $favorieten[] = $row; 
            }
        }
        return($favorieten);
    }  

    private function selecteerBereiding($gerecht_id){
            $bereiding = [];
            $bereidingData = $this -> gerecht_info -> selecteerGerechtInfo($gerecht_id);
            foreach($bereidingData as $row) {
                if ($row["record_type"] === "B"){
                   $bereiding[] = $row; 
                }
            }
            return $bereiding;
    }

    private function selecteerOpmerkingen($gerecht_id){
        $opmerkingen =  [];
        $opmerkingData = $this -> gerecht_info -> selecteerGerechtInfo($gerecht_id);
        foreach($opmerkingData as $row) {
            if ($row["record_type"] === "O"){
                $opmerkingen[] = $row;
            }
        }
        return $opmerkingen;
    }

// Berekeningen 
    private function berekenWaardering($gerecht_id) {
        $waardering = 0;
        $waarderingData = [];
        $gerechtInfo = $this -> gerecht_info -> selecteerGerechtInfo($gerecht_id);
        foreach ($gerechtInfo as $row) {
            if ($row["record_type"] === "W"){
                $waarderingData[] = $row;
            }
        }
        
        foreach($waarderingData as $row){
            $waardering += $row["nummeriekveld"];
        }

        if(count($waarderingData) != 0){
        $waardering = $waardering/count($waarderingData);
        } else{
            $waardering = 0;
        }
        
        return $waardering;
    }

    private function berekenPrijs($gerecht_id){
        $totaal = 0;
        $prijsData=[];
        (float)$totaalPrijs = 0;
        $ingredientData = $this -> ingredient -> selecteerIngredient($gerecht_id);

        foreach ($ingredientData as $prijs) {
            $totaal += (($prijs['prijs']/$prijs['verpakking']) * $prijs['aantal']);
        }
        
        return(round($totaal,2));
    }

    private function berekenKcal($gerecht_id){
        $kcalData = [];
        $kcal = 0;
        $ingredientData = $this -> ingredient -> selecteerIngredient($gerecht_id);
        foreach ($ingredientData as $row){
            $kcal += ($row['aantal'] * $row['kcal']);
        }
        return $kcal;
    }


//  data van recepten ophalen
    public function selecteerRecept($gerecht_id = NULL) {
        $sql = "SELECT * FROM gerecht";

        if(!is_null($gerecht_id)){
            $sql .= "WHERE id = $gerecht_id";
        }

        $gerechten = [];
        $result = mysqli_query($this -> connection, $sql);
        while ($gerechtData = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        
            $gerecht_id = $gerechtData["id"];
            $userData = $this -> selecteerUser($gerechtData["user_id"]);
            $keukenData = $this -> selecteerKeuken($gerechtData["keuken_id"]);
            $typeData = $this -> selecteerType($gerechtData["type_id"]);
            $ingredientData = $this -> selecteerIngredient($gerecht_id);
            $opmerkingData = $this -> selecteerOpmerkingen($gerecht_id);
            $bereidingData = $this -> selecteerBereiding($gerecht_id);
            $favorietData = $this -> selecteerFavoriet($gerecht_id);
            $isFavoriet = $this -> gerecht_info -> isFavoriet($gerecht_id, $gerechtData["user_id"]);

            $gerechten[] = [
                "auteur" => $userData['user_name'],
                "keuken" => $keukenData["omschrijving"],
                "type" => $typeData["omschrijving"],
                "ingredient" => $ingredientData,
                "kcal" => $this -> berekenKcal($gerecht_id),
                "totaal prijs" => $this -> berekenPrijs($gerecht_id),
                "waardering " => $this -> berekenWaardering($gerecht_id),
                "opmerkingen" => $opmerkingData,
                "bereidingen" => $bereidingData,
                "is favoriet" => $isFavoriet,
            ];
        }
        return($gerechten);
    }

}

?>