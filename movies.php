<?php
require_once "include/utilities.php";
$movie = $db->get_movie(htmlspecialchars($_GET["id"]));
if (!$movie) relocate("home");
$page = new Page("movies/" . $movie->id, $movie->title, "Découvrez le film " . $movie->title . " sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
    <?php require "include/head.php"; ?>
    <body>
        <?php require "include/header.php"; ?>
        <main id="main">
            <div id="presentation" class="section movie-presentation">
                <div class="movie-poster">
                    <img class="lazyload" alt data-sizes="auto" data-src="<?= "images/posters/originals/$movie->id.webp" ?>" />
                </div>
                <div class="movie-description">
                    <h1 class="movie-title"><?= $movie->title ?></h1>
                    <p class="movie-info"><?= get_year($movie->release_date) . " • " . get_genres($db->get_genres($movie->id)) . " • " . get_duration($movie->duration) ?></p>
                    <p class="movie-overview"><?= $movie->overview ?></p>
                    <div class="movie-features">
                        <div class="movie-grade">
                            <div class="movie-grade-design"><?= $movie->grade / 10 ?></div>
                            <div class="movie-grade-help">Note des spectateurs</div>
                        </div>
                        <?php if ($db->is_connected()) { ?>
                            <div class="movie-tools">
                                <?php if ($db->is_liked($movie->id, $user->id)) { ?>
                                    <div class="movie-tool active" aria-label="Supprimer le like" title="Supprimer le like"><?php require "include/icons/heart.svg"; ?></div>
                                <?php } else { ?>
                                    <div class="movie-tool" aria-label="Mettre un like" title="Mettre un like"><?php require "include/icons/heart.svg"; ?></div>
                                <?php } ?>
                                <?php if ($db->is_watchlisted($movie->id, $user->id)) { ?>
                                    <div class="movie-tool active" aria-label="Supprimer de votre liste" title="Supprimer de votre liste"><?php require "include/icons/done.svg"; ?></div>
                                <?php } else { ?>
                                    <div class="movie-tool" aria-label="Ajouter à votre liste" title="Ajouter à votre liste"><?php require "include/icons/plus.svg"; ?></div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="movie-details">
                        <div class="movie-detail">
                            <div class="movie-detail-title">Date de sortie</div>
                            <div class="movie-detail-content"><?= get_date($movie->release_date) ?></div>
                        </div>
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