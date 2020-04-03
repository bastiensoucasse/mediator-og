<?php
require_once("../tools/database.php");
require_once("../tools/init.php");
require_once("../tools/utilities.php");

$_PAGE = array(
    "TITLE" => "Mediator",
    "LINK" => "https://" . $_SERVER["HTTP_HOST"],
    "DESCRIPTION" => "La nouvelle base de données cinéatographique de Profuder."
);
?>

<!DOCTYPE html>
<html lang="fr-fr">

<?php require("../tools/get/head.php"); ?>

<body>
    <?php require("../tools/get/header.php"); ?>
    <?php require("../tools/notif.php"); ?>
    <main>
        <div id="search" class="section">
            <div class="section-name">Rechercher</div>
            <div class="section-content">
                <div id="search-box" role="search">
                    <input type="search" id="search-input" role="combobox" aria-autocomplete="list" aria-owns="suggestion-list" aria-expanded="true" placeholder="Recherche" />
                    <div id="suggestion-list" role="list-box">
                        <div class="search-suggestion">suggestion one</div>
                        <div class="search-suggestion">suggestion two</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
