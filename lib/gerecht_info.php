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


    public function selecteerAlsFavoriet($gerecht_id, $user_id){
        $sql = " INSERT INTO gerecht_info (record_type, gerecht_id, user_id) 
        VALUES ('F', $gerecht_id, '$user_id')";

            if (mysqli_query($this->connection, $sql)) {
            echo "New record created successfully";
            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

    public function verwijderFavoriet($gerecht_id){
        $sql = "DELETE FROM gerecht_info WHERE gerecht_id = $gerecht_id AND record_type = F" 


        if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        } else {
        echo "Error deleting record: " . mysqli_error($conn);
        }
        }



}







?>