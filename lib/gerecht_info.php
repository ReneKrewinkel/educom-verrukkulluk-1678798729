<?php


class gerecht_info{
    
    private $connection;
    private $user;

    public function __construct($connection) {
        $this->connection = $connection;
        $this ->user = new user($connection);
    }
  
    private function haalUserOp($user_id){
        $userData = $this -> user -> selecteerUser($user_id);
        return($userData);
    }


    public function selecteerGerechtInfo($gerecht_id) {
        $gerecht_info= [];
        $sql = "SELECT * FROM gerecht_info WHERE gerecht_id = $gerecht_id";
        
        $result = mysqli_query($this->connection, $sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            if ($row["record_type"] == "O" || $row["record_type"] == "F") {
                $user_id = $row["user_id"];
                $user = $this -> haalUserOp($user_id);
                $gerecht_info[] = $row + $user;
            }
            else {
                $gerecht_info[] = $row;
            }
        }

        return($gerecht_info);
    }

    public function isFavoriet($gerecht_id, $user_id){
        $favoriet = 0;
        $sql = "SELECT * FROM gerecht_info WHERE record_type = 'F' AND gerecht_id = $gerecht_id AND user_id = $user_id"; 
        $query = mysqli_query( $this -> connection, $sql);
        $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
        if ($result != NULL){
            $favoriet = 1;
        } 
        // $gerecht_info = $this -> gerecht_info -> selecteerGerechtInfo($gerecht_id);
        // foreach($gerecht_info as $item) {
        //     if ($item["record_type"] === "F"){
        //         if ($item["user_id"] == $user_id){
        //             echo "true1";
        //             $favoriet = TRUE;
        //         return $favoriet;
        //         }
        //     }
        // }
        return $favoriet;
        }


    public function voegFavorietToe($gerecht_id, $user_id){
        $checkFavoriet = $this -> isFavoriet($gerecht_id, $user_id);
        // var_dump($checkFavoriet);
        if ($checkFavoriet != TRUE){
            $sql = " INSERT INTO gerecht_info (record_type, gerecht_id, user_id) 
            VALUES ('F', $gerecht_id, '$user_id')";
            mysqli_query($this->connection, $sql);
        } else{
            return;
        }
    }




        // $checkFavoriet = FALSE;
        // $favoriet=[];
        // $sql = "SELECT * FROM gerecht_info WHERE gerecht_id = $gerecht_id";
        // $result = mysqli_query($this->connection, $sql);
        
        // while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
        //     $favoriet[] = $row;
        // }
        
        // foreach($favoriet as $item) {
        //     if ((in_array("F", $item))){
        //         // echo "F is present";
        //         if ($item["user_id"] == $user_id){
        //             $checkFavoriet = TRUE;
        //         }
        //     }
        // }


        // if ($checkFavoriet === FALSE){
        //     $sql = " INSERT INTO gerecht_info (record_type, gerecht_id, user_id) 
        //     VALUES ('F', $gerecht_id, '$user_id')";
        //     mysqli_query($this->connection, $sql);
        //     echo "favorite added";
        // } else {
        //     echo " nothing happened";
        // }

    // }

    public function verwijderFavoriet($gerecht_id, $user_id){
        $checkFavoriet = $this -> isFavoriet($gerecht_id, $user_id);
        $sql = "DELETE FROM gerecht_info 
        WHERE gerecht_id = $gerecht_id 
        AND record_type = 'F' 
        AND user_id = $user_id"; 

        if ($checkFavoriet == TRUE){
            mysqli_query($this->connection, $sql);
        } else
        return;
    }

    public function toevoegenWaardering($gerecht_id, $waardering) { 
        
        $sql = "INSERT INTO gerecht_info (gerecht_id, record_type, nummeriekveld)
        VALUES ($gerecht_id, 'W', $waardering)";

        return($this->connection->query($sql));
    }


}







?>