<?php
if (substr($_SERVER["REQUEST_URI"], 1, 7) == "library") $active = "library";
else if (substr($_SERVER["REQUEST_URI"], 1, 6) == "browse") $active = "browse";
else $active = "home";
?>
<header>
    <div id="header">
        <a class="logo" href="/" aria-label="Mediator">Mediator</a>
        <?php if (!is_connected()) echo("<a class=\"nav-button\" href=\"/auth?source=" . urlencode($_SERVER["REQUEST_URI"]) . "\" aria-label=\"Se connecter\">Se connecter</a>"); ?>
    </div>
    <div id="nav">
        <a class="nav-link<?= $active == "home" ? " active" : "" ?>" href="/" aria-label="Accueil">Accueil</a>
        <a class="nav-link<?= $active == "browse" ? " active" : "" ?>" href="/browse" aria-label="Parcourir">Parcourir</a>
        <a class="nav-link<?= $active == "library" ? " active" : "" ?>" href="/library" aria-label="Bibliothèque">Bibliothèque</a>
    </div>
</header>