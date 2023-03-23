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

    public function selecteerBereiding($gerecht_id){
            $bereiding = [];
            $bereidingData = $this -> gerecht_info -> selecteerGerechtInfo($gerecht_id);
            foreach($bereidingData as $row) {
                if ($row["record_type"] === "B"){
                   $bereiding[] = $row; 
                }
            }
            return $bereiding;
    }

    public function selecteerOpmerkingen($gerecht_id){
        $opmerkingen =  [];
        $opmerkingData = $this -> gerecht_info -> selecteerGerechtInfo($gerecht_id);
        foreach($opmerkingData as $row) {
            if ($row["record_type"] === "O"){
                $opmerkingen[] = $row;
            }
        }
        return $opmerkingen;
    }

    public function berekenWaardering($gerecht_id) {
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


    public function berekenPrijs($gerecht_id){
        $totaal = 0;
        $prijsData=[];
        (float)$totaalPrijs = 0;
        $ingredientData = $this -> ingredient -> selecteerIngredient($gerecht_id);

        foreach ($ingredientData as $prijs) {
            $totaal += (($prijs['prijs']/$prijs['verpakking']) * $prijs['aantal']);
        }
        
        return(round($totaal,2));

    }

    public function berekenKcal($gerecht_id){
        $kcalData = [];
        $kcal = 0;
        $ingredientData = $this -> ingredient -> selecteerIngredient($gerecht_id);
        foreach ($ingredientData as $row){
            $kcal += ($row['aantal'] * $row['kcal']);
        }
        return $kcal;
    }

    public function selecteerRecepten($gerecht_id_array, $user_id){
        foreach ($gerecht_id_array as $gerecht_id){
            $gerechten[] = $this -> selecteerRecept($gerecht_id, $user_id);
        }
        return $gerechten;
    }


    public function selecteerRecept($gerecht_id, $user_id) {
        $sql = " SELECT * FROM gerecht WHERE id = $gerecht_id";
        $result = mysqli_query($this -> connection, $sql);
        $gerechtData = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $userData = $this -> selecteerUser($gerechtData["user_id"]);
        $keukenData = $this -> selecteerKeuken($gerechtData["keuken_id"]);
        $typeData = $this -> selecteerType($gerechtData["type_id"]);
        $ingredientData = $this -> selecteerIngredient($gerecht_id);
        $opmerkingData = $this -> selecteerOpmerkingen($gerecht_id);
        $bereidingData = $this -> selecteerBereiding($gerecht_id);
        $favorietData = $this -> selecteerFavoriet($gerecht_id);
        $isFavoriet = $this -> gerecht_info -> isFavoriet($gerecht_id, $user_id);
        
        foreach ($ingredientData as $ingredient){
            $ingredienten[] = [
                "naam" => $ingredient['naam'],
                "omschrijving" => $ingredient['omschrijving'],
                "prijs" => $ingredient['prijs'],
                "aantal" => $ingredient["aantal"]
            ];
        }
        foreach ($opmerkingData as $opmerking){
            $opmerkingen[] = [
                "naam" => $opmerking['user_name'],
                "opmerking" => $opmerking['tekstveld'],
                "afbeelding" => $opmerking['afbeelding']
            ];
        }
        foreach ($bereidingData as $bereiding){
            $bereidingen[] = [
                "stap" => $bereiding['nummeriekveld'],
                "instructie" => $bereiding['tekstveld']
            ];
        }
        
        $gerechtData["auteur"] = $userData['user_name'];
        $gerechtData["keuken"] = $keukenData["omschrijving"];
        $gerechtData["type"] = $typeData["omschrijving"];
        $gerechtData["ingredient"]= $ingredienten;
        $gerechtData["kcal"] = $this -> berekenKcal($gerecht_id);
        $gerechtData["totaal prijs"] = $this -> berekenPrijs($gerecht_id);
        $gerechtData["waardering "] = $this -> berekenWaardering($gerecht_id);
        $gerechtData ["opmerkingen"] = $opmerkingen;
        $gerechtData ["bereidingen"] = $bereidingen;
        $gerechtData ["is favoriet"] = $isFavoriet;

        return($gerechtData);
    }



}







?>