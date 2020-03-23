<?php
require_once("../tools/database.php");
require_once("../tools/init.php");
require_once("../tools/utilities.php");
?>

<!DOCTYPE html>
<html lang="fr-fr">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Retrouvez vos commandes sur Mediator." />
    <meta name="theme-color" content="#111111" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="/icon.png" />
    <link rel="apple-touch-icon" href="/icon.png" />
    <link rel="manifest" href="/manifest.webmanifest" />
    <link rel="stylesheet" href="/style.css" />
    <script>if ("serviceWorker" in navigator) navigator.serviceWorker.register("/service-worker.js");</script>
    <title>Commandes - Mediator</title>
</head>

<body>
    <header>
        <div id="header">
            <a class="logo" href="/" aria-label="Mediator">Mediator</a>
            <?php
            if (!is_connected())
            {
            ?>
                <a class="nav-button" href="<?= "/auth?source=" . urlencode($_SERVER["REQUEST_URI"]) ?>" aria-label="Se connecter">Se connecter</a>
            <?php
            }
            ?>
        </div>
        <div id="nav">
            <a class="nav-link" href="/" aria-label="Accueil">Accueil</a>
            <a class="nav-link" href="/browse" aria-label="Parcourir">Parcourir</a>
            <a class="nav-link active" href="/library" aria-label="Bibliothèque">Bibliothèque</a>
        </div>
    </header>
    <main>
        <?php
        if (!is_connected())
        {
        ?>
            <div id="auth" class="section">
                <div class="section-name">Commandes</div>
                <div class="section-content">
                    Veuillez vous connecter pour retrouver vos commandes.
                    <a class="button" href="<?= "/auth?source=" . urlencode($_SERVER["REQUEST_URI"]) ?>" aria-label="Se connecter">Se connecter</a>
                </div>
            </div>
        <?php
        }
        else
        {
        ?>
            <div id="orders" class="section">
                <div class="section-name">Commandes</div>
                <div class="section-content commands-list">
                    <?php
                    $stmt = $db->prepare("SELECT `CommandID` FROM `Commands` WHERE `UserID` = ? ORDER BY `Date` DESC");
                    $stmt->execute(array(htmlspecialchars($_SESSION["id"])));
                    $commands = $stmt->fetchAll();
                    if (!$commands)
                        echo ("Vous n'avez effectué aucune commande.");
                    else
                    {
                        foreach ($commands as $c)
                        {
                    ?>
                            <div id="command-<?= $c["CommandID"] ?>" class="command-container">
                                <script>
                                    xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function() {
                                        if (this.readyState == 4 && this.status == 200)
                                            document.querySelector("#command-<?= $c["CommandID"] ?>").innerHTML = this.responseText;
                                    };
                                    xhttp.open("GET", "../tools/get/command.php?id=<?= $c["CommandID"] ?>", true);
                                    xhttp.send();
                                </script>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
    </main>
</body>

</html>
