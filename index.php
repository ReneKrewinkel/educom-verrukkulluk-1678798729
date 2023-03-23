<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keuken_type.php"); 
require_once("lib/ingredient.php");
require_once("lib/gerecht_info.php");
require_once("lib/gerecht.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$user = new user($db -> getConnection());
$keukenType = new keukenType($db->getConnection());
$ingredient = new ingredient($db->getConnection());
$gerecht_info = new gerecht_info($db->getConnection());
$gerecht = new gerecht($db -> getConnection());



/// VERWERK 
// $dataArtikel = $art->selecteerArtikel(3);
// $dataUser = $user -> selecteerUser(2);
// $dataKeukenType = $keukenType -> selecteerKeukenType(1);
// $dataIngredient = $ingredient -> selecteerIngredient(1);
// $dataGerechtInfo = $gerecht_info -> selecteerGerechtInfo(21);
// $voegFavorietToe = $gerecht_info -> voegFavorietToe(22, 2);
// $verwijderFavoriet = $gerecht_info -> verwijderFavoriet(24, 2);
$dataGerecht = $gerecht ->selecteerRecept(21, 4);
$dataGerechten = $gerecht -> selecteerRecepten(array(21, 22), 4);
// $isFavorietGerecht = $gerecht_info ->isFavoriet(22,2);
// $prijsData = $gerecht -> berekenPrijs(21);
// $bereiding = $gerecht -> selecteerBereiding(21);
// $opmerkingen = $gerecht -> selecteerOpmerkingen(21);
// $waardering = $gerecht -> berekenWaardering(21);
// $kcal = $gerecht -> berekenKcal(22);

echo "<pre>";
// var_dump($dataArtikel);
// echo '<br>';	
// var_dump($dataUser);
// echo "<br>";
// var_dump($dataKeukenType);

// var_dump($dataIngredient);
// echo '<br>';
// var_dump($dataGerechtInfo);
// var_dump($voegFavorietToe);
// var_dump($dataGerecht);
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
var_dump($dataGerechten);
// var_dump($isFavorietGerecht);
// echo $prijsData;
echo "<br>";
// var_dump($bereiding);
// var_dump($opmerkingen);
// var_dump($waardering);
// var_dump($kcal);
echo "</pre>";



