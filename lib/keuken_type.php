<?php

class keukenType{
    private $connection;

    public function __construct($connection) {
        $this -> connection = $connection;
    }

    public function selecteerKeukenType($keukenType_id) {
        $sql = "SELECT * FROM keuken_type WHERE id = $keukenType_id";
        $result = mysqli_query($this->connection, $sql);
        $keukenType = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return ($keukenType);

    }
} 
?>