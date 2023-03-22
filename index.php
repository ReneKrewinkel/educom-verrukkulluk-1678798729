<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keuken_type.php"); 
require_once("lib/ingredient.php");
require_once("lib/gerecht_info.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$user = new user($db -> getConnection());
$keukenType = new keukenType($db->getConnection());
$ingredient = new ingredient($db->getConnection());
$gerecht_info = new gerecht_info($db->getConnection());



/// VERWERK 
// $dataArtikel = $art->selecteerArtikel(3);
// $dataUser = $user -> selecteerUser(2);
// $dataKeukenType = $keukenType -> selecteerKeukenType(1);
// $dataIngredient = $ingredient -> selecteerIngredient(1);
$dataGerechtInfo = $gerecht_info -> selecteerGerechtInfo(21);
// $voegFavorietToe = $gerecht_info -> selecteerAlsFavoriet(23, 3);
// $verwijderFavoriet = $gerecht_info -> verwijderFavoriet(23);

echo "<pre>";
// var_dump($dataArtikel);
// echo '<br>';	
// var_dump($dataUser);
// echo "<br>";
// var_dump($dataKeukenType);

// var_dump($dataIngredient);
// echo '<br>';
var_dump($dataGerechtInfo);
echo '<br>';
// var_dum($voegFavorietToe);
echo "</pre>";



