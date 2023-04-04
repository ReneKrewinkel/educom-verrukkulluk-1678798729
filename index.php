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
$rating = isset($_GET["rating"]) ? $_GET["rating"] : "";
$artikel_id = isset($_GET["artikel_id"]) ? $_GET["artikel_id"] : "";


$user_id = 1;


switch($action) {

        case "homepage": {
            $data = $gerecht->selecteerGerechten();
            $template = 'homepage.html.twig';
            $title = "homepage";
            break;
        }

        case "detail": {
            $data = $gerecht->selecteerGerechten(intval($gerecht_id));
            $template = 'detail.html.twig';
            $title = "detail pagina";
            break;
        }

        case "boodschappenlijst": {
            $boodschappen -> toevoegenBoodschappenRecept($gerecht_id, $user_id);
            $data = $boodschappen -> ophalenDataBoodschappenlijstUser($user_id);
            $template = 'boodschappenlijst.html.twig';
            $title = 'Boodschappenlijst';
            break;
        }

        case "verwijderBoodschap": {
            $boodschappen -> verwijderBoodschap($user_id, $artikel_id);
            $data = $boodschappen -> ophalenDataBoodschappenlijstUser($user_id);
            $template = 'boodschappenlijst.html.twig';
            $title = 'Boodschappenlijst';
            break; 
        }

        case "toevoegenFavoriet": {
            $gerecht_info->voegFavorietToe($gerecht_id, $user_id);
            $template = 'detail.html.twig';
            $title = "detail pagina";
            break;
        }

        case "verwijderFavoriet": {
            $gerecht_info->verwijderFavoriet($gerecht_id, $user_id);
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

        case "toevoegenWaardering": {
            $gerecht_info -> toevoegenWaardering($gerecht_id, $rating);
            $template = 'detail.html.twig';
            $title = "detail pagina";
            break;
        }



        /// etc

}


// echo "<pre>";
// var_dump($data);
// die();

/// Onderstaande code schrijf je idealiter in een layout klasse of iets dergelijks
/// Juiste template laden, in dit geval "homepage"
$template = $twig->load($template);


/// En tonen die handel!
echo $template->render(["title" => $title, "data" => $data]);
?>