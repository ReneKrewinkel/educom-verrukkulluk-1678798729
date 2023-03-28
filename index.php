<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keuken_type.php"); 
require_once("lib/ingredient.php");
require_once("lib/gerecht_info.php");
require_once("lib/gerecht.php");
require_once("lib/boodschappenlijst.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$user = new user($db -> getConnection());
$keukenType = new keukenType($db->getConnection());
$ingredient = new ingredient($db->getConnection());
$gerecht_info = new gerecht_info($db->getConnection());
$gerecht = new gerecht($db -> getConnection());
$boodschappen = new boodschappenlijst($db -> getConnection());

/// VERWERK 
// $dataArtikel = $art->selecteerArtikel(3);
// $dataUser = $user -> selecteerUser(2);
// $dataKeukenType = $keukenType -> selecteerKeukenType(1);
// $dataIngredient = $ingredient -> selecteerIngredient(1);
// $dataGerechtInfo = $gerecht_info -> selecteerGerechtInfo(21);
// $voegFavorietToe = $gerecht_info -> voegFavorietToe(22, 2);
// $verwijderFavoriet = $gerecht_info -> verwijderFavoriet(24, 2);
// $dataGerecht = $gerecht ->selecteerRecept(1);
// $dataGerechten = $gerecht -> selecteerRecepten(array(21, 21), 4);
// $isFavorietGerecht = $gerecht_info ->isFavoriet(22,2);
// $prijsData = $gerecht -> berekenPrijs(21);
// $bereiding = $gerecht -> selecteerBereiding(21);
// $opmerkingen = $gerecht -> selecteerOpmerkingen(21);
// $waardering = $gerecht -> berekenWaardering(21);
// $kcal = $gerecht -> berekenKcal(22);
// $boodschappenData = $boodschappen -> toevoegenBoodschappenRecept(22, 4);

// echo "<pre>";
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
// echo '<br>';
// echo '<br>';
// echo '<br>';
// echo '<br>';
// var_dump($dataGerechten);
// var_dump($isFavorietGerecht);
// echo $prijsData;
// echo "<br>";
// var_dump($bereiding);
// var_dump($opmerkingen);
// var_dump($waardering);
// var_dump($kcal);
// echo "</pre>";


//// Allereerst zorgen dat de "Autoloader" uit vendor opgenomen wordt:
require_once("vendor/autoload.php");

/// Twig koppelen:
$loader = new \Twig\Loader\FilesystemLoader("templates");
/// VOOR PRODUCTIE:
/// $twig = new \Twig\Environment($loader), ["cache" => "./cache/cc"]);

/// VOOR DEVELOPMENT:
$twig = new \Twig\Environment($loader, ["debug" => true ]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

/******************************/

/// Next step, iets met je data doen. Ophalen of zo
$data = $gerecht->selecteerGerechten();


/*
URL:
http://localhost/index.php?gerecht_id=4&action=detail
*/

$gerecht_id = isset($_GET["gerecht_id"]) ? $_GET["gerecht_id"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";


switch($action) {

        case "homepage": {
            $data = $gerecht->selecteerGerechten();
            $template = 'homepage.html.twig';
            $title = "homepage";
            break;
        }

        case "detail": {
            $data = $gerecht->selecteerGerechten();
            $template = 'detail.html.twig';
            $title = "detail pagina";
            break;
        }

        case "boodschappenlijst": {
            $data = $boodschappen -> ophalenBoodschappenlijstUser($user_id);
            $template = 'detail.html.twig';
            $title = 'Boodschappenlijst';
            break;
        }

        case "favoriet": {
            $data = $gerecht->selecteerFavoriet($user_id);
            $template = 'detail.html.twig';
            $title = "detail pagina";
            break;
        }

        case "zoeken": {
            // $data = );
            $template = 'detail.html.twig';
            $title = "detail pagina";
            break;
        }

        case "waardering": {
            $data = $gerecht -> berekenWaardering($gerecht_id);
            $template = 'detail.html.twig';
            $title = "detail pagina";
            break;
        }



        /// etc

}


/// Onderstaande code schrijf je idealiter in een layout klasse of iets dergelijks
/// Juiste template laden, in dit geval "homepage"
$template = $twig->load($template);


/// En tonen die handel!
echo $template->render(["title" => $title, "data" => $data]);
