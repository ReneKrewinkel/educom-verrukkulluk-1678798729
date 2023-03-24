<?php



class boodschappenlijst{

    private function __construct($connection) {
        $this -> connection = $connection;
        $this -> ingredient = new ingredient($connection);
        $this -> artikel = new artikel($connection);
    }

    private function ophalenIngredient($gerecht_id){
        $ingredienten = $this -> ingredient -> selecteerIngredient($gerecht_id);
        return $ingredienten;//ophalen ingredienten
    }

    private function ophalenArtikel($artikel_id){
        $artikel = $this -> artikel -> selecteerArtikel($artikel_id);
        return $artikel;
    }

    private function ophalenBoodschappenlijstUser($user_id){
        $sql = "SELECT * FROM boodschappenlijst WHERE user_id = $user_id";
        $boodschappenlijstUser = mysqli_query($this -> connection, $sql);
        return $boodschappenlijstUser;
    }

    private function ophalenBoodschapUser($artikel_id, $user_id){
        $sql = "SELECT * FROM boodschappenlijst WHERE artikel_id = $artikel_id AND user_id = $user_id";
        $result = mysqli_query($this -> connection, $sql);
        $boodschapUser = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $boodschapUser;
    }

    public function updateBoodschapAantal($artikel_id, $user_id, $nieuwAantal){
        $artikelData = $this -> ophalenArtikel($artikel_id);      
        $ingebruik = $nieuwAantal * $artikelData["verpakking"];
        $sql = "UPDATE boodschappenlijst 
                SET bestelAantal = $nieuwAantal AND ingebruik = $ingebruik  /* $nieuwAantal moet nog uit de front-end geladen worden*/
                WHERE user_id = $user_id AND artikel_id = $artikel_id" ;
        mysqli_query($this -> connection, $sql);
    }

    public function verwijderBoodschap ($user_id, $artikel_id){
        $sql = "DELETE FROM boodschappenlijst 
        WHERE user_id = $user_id AND artikel_id = $artikel_id";
        mysqli_query($this -> connection, $sql);
    }

    public function leegmakenBoodschappen($user_id){
        $sql = "DELETE FROM boodschappenlijst
        WHERE user_id = $user_id";
        myswli_query($this->connection, $sql);
    }


    private function boodschappenAantal($ingredient, $user_id){
            if(($this -> artikelOpLijst($ingredient["artikel_id"], $user_id))!= FALSE){
                $boodschapUser = $this -> ophalenBoodschapUser($ingredient["artikel_id"], $user_id);
                $ingebruik = $ingredient['aantal'] + $boodschapUser["ingebruik"];
            }else{
                $ingebruik = $ingredient['aantal'];
            }   
            $bestelAantal = ceil($ingebruik/$ingredient['verpakking']);
        return array($bestelAantal, $ingebruik);
    }
    

    public function toevoegenBoodschappenRecept($gerecht_id, $user_id){
        $ingredienten = $this -> ophalenIngredient($gerecht_id);

        foreach ($ingredienten as $ingredient) {
            $artikel_id = $ingredient["artikel_id"];
            if(($this -> artikelOpLijst($artikel_id, $user_id))!= FALSE){                    
                list($bestelAantal, $ingebruik) = $this -> boodschappenAantal($ingredient, $user_id);
                $sql = "UPDATE boodschappenlijst 
                    SET bestelAantal= $bestelAantal, ingebruik= $ingebruik
                    WHERE user_id = $user_id AND artikel_id = $artikel_id";
                    mysqli_query($this -> connection, $sql);                
                    echo "boodschap geupdate <br>";
                    
            }else{
                list($bestelAantal, $ingebruik) = $this -> boodschappenAantal($ingredient, $user_id);
                $sql = "INSERT INTO boodschappenlijst 
                (user_id, artikel_id, bestelAantal, ingebruik) 
                VALUES($user_id, $artikel_id, $bestelAantal, $ingebruik)";
                mysqli_query($this -> connection, $sql);
                echo" boodschap toegevoegd <br>";
            }
        }
    }


    private function artikelOpLijst($artikel_id, $user_id){
        $boodschappen = $this -> ophalenBoodschappenlijstUser($user_id);
        foreach($boodschappen as $boodschap){
            if ($boodschap["artikel_id"] == $artikel_id){
                return $boodschap;
            }
        }
    }

}


?>