<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keuken_type.php"); 
require_once("lib/ingredient.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$user = new user($db -> getConnection());
$keukenType = new keukenType($db->getConnection());
$ingredient = new ingredient($db->getConnection());


/// VERWERK 
$dataArtikel = $art->selecteerArtikel(3);
// $dataUser = $user -> selecteerUser(2);
// $dataKeukenType = $keukenType -> selecteerKeukenType(1);
$dataIngredient = $ingredient -> selecteerIngredient(1);

/// RETURN
// var_dump($dataArtikel);
// echo '<br>';	
// var_dump($dataUser);
// echo "<br>";
// var_dump($dataKeukenType);
echo "<pre>";
var_dump($dataIngredient);