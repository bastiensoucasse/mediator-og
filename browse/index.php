<?php
require_once("../tools/database.php");
require_once("../tools/init.php");
require_once("../tools/utilities.php");

$_PAGE = array(
    "TITLE" => "Parcourir - Mediator",
    "LINK" => "https://" . $_SERVER["HTTP_HOST"] . "/browse",
    "DESCRIPTION" => "Parcourez la base de données cinéatographique Mediator."
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
                    <input type="search" id="search-input" role="combobox" aria-autocomplete="list" aria-owns="suggestion-list" aria-expanded="false" placeholder="Recherche" />
                    <div id="suggestion-list" role="list-box"></div>
                </div>
            </div>
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

            if (q == "") path = "../tools/get/search-history";
            else path = "../tools/get/suggestion-list?q=" + q;
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
