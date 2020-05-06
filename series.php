<?php
require_once "include/utilities.php";
$series = $db->get_series(htmlspecialchars($_GET["id"]));
if (!$series) relocate("home");
$page = new Page("series/" . $series->id, $series->title, "Découvrez la série " . $series->title . " sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
    <?php require "include/head.php"; ?>
    <body>
        <?php require "include/header.php"; ?>
        <main id="main">
            <div id="presentation" class="section series-presentation">
                <div class="series-poster">
                    <img class="lazyload" alt data-sizes="auto" data-src="<?= "images/posters/originals/$series->id.webp" ?>" />
                </div>
                <div class="series-description">
                    <h1 class="series-title"><?= $series->title ?></h1>
                    <p class="series-info"><?= get_year($series->start_date) . " • " . get_genres($db->get_genres($series->id)) . " • " . get_seasons($series->seasons) ?></p>
                    <p class="series-overview"><?= $series->overview ?></p>
                    <div class="series-features">
                        <div class="series-grade">
                            <div class="series-grade-design"><?= $series->grade / 10 ?></div>
                            <div class="series-grade-help">Note des spectateurs</div>
                        </div>
                        <?php if ($db->is_connected()) { ?>
                            <div class="series-tools">
                                <?php if ($db->is_liked($series->id, $user->id)) { ?>
                                    <div class="series-tool active" aria-label="Supprimer le like" title="Supprimer le like"><?php require "include/icons/heart.svg"; ?></div>
                                <?php } else { ?>
                                    <div class="series-tool" aria-label="Mettre un like" title="Mettre un like"><?php require "include/icons/heart.svg"; ?></div>
                                <?php } ?>
                                <?php if ($db->is_watchlisted($series->id, $user->id)) { ?>
                                    <div class="series-tool active" aria-label="Supprimer de votre liste" title="Supprimer de votre liste"><?php require "include/icons/done.svg"; ?></div>
                                <?php } else { ?>
                                    <div class="series-tool" aria-label="Ajouter à votre liste" title="Ajouter à votre liste"><?php require "include/icons/plus.svg"; ?></div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="series-details">
                        <div class="series-detail">
                            <div class="series-detail-title">Date de début</div>
                            <div class="series-detail-content"><?= get_date($series->start_date) ?></div>
                        </div>
                        <?php if ($series->status == "Ended" || $series->status == "Cancelled") { ?>
                            <div class="series-detail">
                                <div class="series-detail-title">Date de fin</div>
                                <div class="series-detail-content"><?= get_date($series->end_date) ?></div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div id="stars" class="section">
                <h2 class="section-name">Tête d'affiche</h2>
                <div class="section-content">
                    <p>Cette fonctionnalité est en développement</p>
                </div>
            </div>
            <div id="media" class="section">
                <h2 class="section-name">Médias</h2>
                <div class="section-content">
                    <p>Cette fonctionnalité est en développement</p>
                </div>
            </div>
            <div id="recommendations" class="section">
                <h2 class="section-name">Recommandations</h2>
                <div class="section-content">
                    <p>Cette fonctionnalité est en développement</p>
                </div>
            </div>
        </main>
    </body>
</html>
