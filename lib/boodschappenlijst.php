<?php



class boodschappenlijst{

    public function __construct($connection) {
        $this -> connection = $connection;
        $this -> ingredient = new ingredient($connection);
    }

    public function ophalenIngredient($gerecht_id){
        $ingredienten = $this -> ingredient -> selecteerIngredient($gerecht_id);
        return $ingredienten;//ophalen ingredienten
    }

    public function toevoegenBoodschappen($gerecht_id){
        $ingredienten = $this -> ophalenIngredient($gerecht_id);
        $boodschappenijst; // boodschappenlijst van user ophalen
        foreach ($ingredienten as $ingredient) {
            if(($this -> artikelOpLijst($ingredient["artikel_id"], $user_id))!= FALSE){
                
            }else{

            }

        }
    }

    public function artikelOpLijst($artikel_id, $user_id){
        $boodschappen = $this -> ophalenBoodschappen($user_id);
        foreach($boodschappen as $boodschap){
            if ($boodschap["artikel_id"] == $artikel_id){
                return $boodschap;
            }
        }
    }

}


?>