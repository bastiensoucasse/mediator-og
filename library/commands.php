<?php
require_once("../tools/database.php");
require_once("../tools/init.php");
require_once("../tools/utilities.php");

$_PAGE = array(
    "TITLE" => "Bibliothèque - Mediator",
    "LINK" => "https://" . $_SERVER["HTTP_HOST"] . "/browse/library",
    "DESCRIPTION" => "Parcourez votre bibliothèque sur Mediator."
);
?>

<!DOCTYPE html>
<html lang="fr-fr">

<?php include("../tools/get/head.php"); ?>

<body>
    <?php include("../tools/get/header.php"); ?>
    <main>
        <?php
        if (!is_connected())
        {
            include("../tools/get/out.php");
            exit;
        }
        ?>
        <div id="orders" class="section">
            <div class="section-name">Commandes</div>
            <div class="section-content commands-list">
                <?php
                $stmt = $db->prepare("SELECT `CommandID`, `Type` FROM `Commands` WHERE `UserID` = ? ORDER BY `Date` DESC");
                $stmt->execute(array(htmlspecialchars($_SESSION["id"])));
                $commands = $stmt->fetchAll();
                if (!$commands) echo ("Vous n'avez effectué aucune commande.");
                else foreach ($commands as $c)
                {
                    if ($c["Type"] == "series")
                    {
                        $stmt = $db->prepare("SELECT `CommandID`, `Type`, `Title`, `Date` FROM `Commands` INNER JOIN `Series` ON `Series`.`SeriesID` = `Commands`.`ContentID` WHERE `CommandID` = ?");
                        $stmt->execute(array($c["CommandID"]));
                        $c = $stmt->fetch();
                    }
                    else
                    {
                        $stmt = $db->prepare("SELECT `CommandID`, `Type`, `Title`, `Date` FROM `Commands` INNER JOIN `Movies` ON `Movies`.`MovieID` = `Commands`.`ContentID` WHERE `CommandID` = ?");
                        $stmt->execute(array($c["CommandID"]));
                        $c = $stmt->fetch();
                    }
                    include("../tools/get/command.php");
                }
                ?>
            </div>
        </div>
    </main>
</body>

</html>
