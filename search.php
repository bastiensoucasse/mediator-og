<?php
require_once("tools/database.php");
require_once("tools/init.php");
require_once("tools/utilities.php");

$query = htmlspecialchars($_GET["q"]);
$userID = htmlspecialchars($_SESSION["id"]);

if (!$query)
{
    header("Location: /browse");
    exit;
}

$_PAGE = array(
    "TITLE" => "$query - Mediator",
    "LINK" => "https://" . $_SERVER["HTTP_HOST"] . "/search?q=$query",
    "DESCRIPTION" => "Recherche de $query sur Mediator."
);

if ($userID)
{
    $stmt = $db->prepare("INSERT INTO `Searches`(`UserID`, `Query`, `Date`) VALUES (?, ?, NOW())");
    $stmt->execute(array($userID, $query));
}

$stmt = $db->prepare("SELECT M.`MovieID`, M.`Title`, M.`ReleaseDate`, M.`PosterPath` FROM `Credits` C INNER JOIN `Movies` M ON M.`MovieID` = C.`ContentID` INNER JOIN `Persons` P ON P.`PersonID` = C.`PersonID` WHERE C.`Type` = \"movie\" AND M.`AddDate` IS NOT NULL AND (M.`Title` LIKE :q OR P.`Name` LIKE :q) GROUP BY M.`MovieID` ORDER BY M.`AddDate` DESC LIMIT 8");
$stmt->execute(array("q" => "%$query%"));
$movies = $stmt->fetchAll();

$stmt = $db->prepare("SELECT S.`SeriesID`, S.`Title`, S.`StartDate`, S.`PosterPath` FROM `Credits` C INNER JOIN `Series` S ON S.`SeriesID` = C.`ContentID` INNER JOIN `Persons` P ON P.`PersonID` = C.`PersonID` WHERE C.`Type` = \"series\" AND S.`AddDate` IS NOT NULL AND (S.`Title` LIKE :q OR P.`Name` LIKE :q) GROUP BY S.`SeriesID` ORDER BY S.`AddDate` DESC LIMIT 8");
$stmt->execute(array("q" => "%$query%"));
$series = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr-fr">

<?php require("tools/get/head.php"); ?>

<body>
    <?php require("tools/get/header.php"); ?>
    <?php require("tools/notif.php"); ?>
    <main>
        <div id="search" class="section">
            <div class="section-name">Rechercher</div>
            <div class="section-content">
                <div id="search-box" role="search">
                    <input type="search" id="search-input" role="combobox" aria-autocomplete="list" aria-owns="suggestion-list" aria-expanded="false" value="<?= $query ?>" />
                    <div id="suggestion-list" role="list-box"></div>
                </div>
            </div>
        </div>
        <div id="results" class="section">
            <?php if (!$movies && !$series): ?>
                <div class="section-name">Recherche</div>
                <div class="section-content">
                    Votre recherche ne retourne aucun résultat.
                </div>
            <?php endif; ?>

            <?php if ($movies): ?>
                <div class="section-name">Films</div>
                <div class="section-content movies-list">
                    <?php foreach ($movies as $m) require("tools/get/movie.php"); ?>
                </div>
            <?php endif; ?>

            <?php if ($series): ?>
                <div class="section-name">Séries</div>
                <div class="section-content series-list">
                    <?php foreach ($series as $s) require("tools/get/series.php"); ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <script>
        let searchInput = document.querySelector("#search-input");
        let suggestionList = document.querySelector("#suggestion-list");

        function loadSuggestions()
        {
            q = searchInput.value.trim().toLowerCase();

            if (window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
            else xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

            xmlhttp.onreadystatechange = function()
            {
                if (this.readyState == 4 && this.status == 200)
                    suggestionList.innerHTML = this.responseText;
            }

            if (q == "") path = "tools/get/search-history";
            else path = "tools/get/suggestion-list?q=" + q;
            xmlhttp.open("GET", path, true);
            xmlhttp.send();
        };

        searchInput.addEventListener("focus", event =>
        {
            searchInput.setAttribute("aria-expanded", true);
            loadSuggestions();
        });

        searchInput.addEventListener("input", event =>
        {
            loadSuggestions();
        });

        searchInput.addEventListener("blur", event =>
        {
            setTimeout(function() { searchInput.setAttribute("aria-expanded", false); }, 210);
        });
    </script>
</body>

</html>
