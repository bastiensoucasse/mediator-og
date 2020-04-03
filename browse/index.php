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

            if (q == "")
            {
                console.log("TODO: Load search history.");
                return;
            }

            if (window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
            else xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

            xmlhttp.onreadystatechange = function()
            {
                if (this.readyState == 4 && this.status == 200)
                    suggestionList.innerHTML = this.responseText;
            }

            xmlhttp.open("GET","../tools/get/suggestion-list?q=" + q, true);
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
            searchInput.setAttribute("aria-expanded", false);
        });
    </script>
</body>

</html>
