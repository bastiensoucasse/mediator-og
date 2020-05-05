<?php
require_once "include/utilities.php";

$movie = get_movie(htmlspecialchars($_GET["id"]));
if (!$movie) relocate("home");
$movie = (object) $movie;

$page = array(
    "id" => "movie/" . $movie->id,
    "name" => $movie->title,
    "description" => "Découvrez le film " . $movie->title . " sur Mediator."
);
?>

<!doctype html>
<html lang="fr-fr">
    <?php require "include/head.php"; ?>

    <body>
        <?php require "include/header.php"; ?>

        <main id="main">
            <div id="presentation" class="section movie-presentation">
                <div class="movie-poster">
                    <img alt src="<?= get_poster($movie->poster) ?>" />
                </div>
                <div class="movie-description">
                    <h1 class="movie-title"><?= $movie->title ?></h1>
                    <p class="movie-info"><?= get_year($movie->release_date) . " • " . get_duration($movie->duration) ?></p>
                    <p class="movie-overview"><?= $movie->overview ?></p>
                    <div class="movie-features">
                        <div class="movie-grade">
                            <div class="movie-grade-design"><?= get_grade($movie->grade) ?></div>
                            <div class="movie-grade-help">Note des spectateurs</div>
                        </div>
                        <?php if (is_connected()) { ?>
                            <div class="movie-tools">
                                <?php if (is_liked($movie->id, $user->id)) { ?>
                                    <div class="movie-tool active" aria-label="Supprimer le like" title="Supprimer le like"><?php include "include/icons/heart.svg"; ?></div>
                                <?php } else { ?>
                                    <div class="movie-tool" aria-label="Mettre un like" title="Mettre un like"><?php include "include/icons/heart.svg"; ?></div>
                                <?php } ?>
                                <?php if (is_watchlisted($movie->id, $user->id)) { ?>
                                    <div class="movie-tool active" aria-label="Supprimer de votre liste" title="Supprimer de votre liste"><?php include "include/icons/done.svg"; ?></div>
                                <?php } else { ?>
                                    <div class="movie-tool" aria-label="Ajouter à votre liste" title="Ajouter à votre liste"><?php include "include/icons/plus.svg"; ?></div>
                                <?php } ?>
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
