<?php
require_once "include/utilities.php";
$movie = $db->get_movie(htmlspecialchars($_GET["id"]));
if (!$movie) relocate("home");
$genres = $db->get_genres($movie->id);
$crew = $db->get_crew($movie->id);
$cast = $db->get_cast($movie->id);
$page = new Page("movies?id=$movie->id", "$movie->title", "Découvrez le film $movie->title sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <div class="background"><img class="lazyload" alt data-sizes="auto" data-src="<?= "/images/backdrops/originals/$movie->id.webp"?>" /></div>
    <div class="background-header"></div>
    <?php require "include/header.php"; ?>
    <main id="main">
        <div id="presentation" class="section movie-presentation">
            <div class="movie-image">
                <div class="movie-poster">
                    <img class="lazyload" alt data-sizes="auto" data-src="<?= "/images/posters/originals/$movie->id.webp" ?>" />
                </div>
            </div>
            <div class="movie-description">
                <h1 class="movie-title"><?= $movie->title ?></h1>
                <p class="movie-info paragraph">
                    <a class="link" href="/movies" aria-label="Films">Film</a>
                    •
                    <?php
                    foreach ($genres as $genre_id => $genre) $genre_links[$genre_id] = "<a class=\"link\" href=\"genres?id=" . $genre->id . "\" aria-label=\"" . $genre->name . "\">" . $genre->name . "</a>";
                    echo implode(", ", $genre_links);
                    ?>
                </p>
                <p class="movie-overview paragraph"><?= $movie->overview ?></p>
            </div>
            <div class="movie-details">
                <?php if (!empty($movie->release_date)) { ?>
                    <div class="movie-detail">
                        <h6 class="movie-detail-title">Sorti le</h6>
                        <p class="movie-detail-content"><?= get_date($movie->release_date) ?></p>
                    </div>
                <?php } ?>
                <?php if (!empty($movie->duration)) { ?>
                    <div class="movie-detail">
                        <h6 class="movie-detail-title">Dure</h6>
                        <p class="movie-detail-content"><?= get_duration($movie->duration) ?></p>
                    </div>
                <?php } ?>
                <?php if (!empty($crew)) { ?>
                    <div class="movie-detail">
                        <h6 class="movie-detail-title">Réalisé par</h6>
                        <?php
                        foreach ($crew as $crew_id => $crew_member) $crew_links[$crew_id] = "<a class=\"link\" href=\"persons?id=" . $crew_member->id . "\" aria-label=\"" . $crew_member->name . "\">" . $crew_member->name . "</a>";
                        echo "<p class=\"movie-detail-content\">", implode("<br />", $crew_links), "</p>";
                        ?>
                    </div>
                <?php } ?>
                <?php if (!empty($cast)) { ?>
                    <div class="movie-detail">
                        <h6 class="movie-detail-title">Avec</h6>
                        <?php
                        foreach ($cast as $cast_id => $cast_member) $cast_links[$cast_id] = "<a class=\"link\" href=\"persons?id=" . $cast_member->id . "\" aria-label=\"" . $cast_member->name . "\">" . $cast_member->name . "</a>";
                        echo "<p class=\"movie-detail-content\">", implode("<br />", $cast_links), "</p>";
                        ?>
                    </div>
                <?php } ?>
                <div class="movie-features">
                    <div class="movie-grade">
                        <div class="movie-grade-design"><?= $movie->grade / 10 ?></div>
                        <p class="movie-grade-help">Note des spectateurs</p>
                    </div>
                    <?php if ($db->is_connected()) { ?>
                        <div class="movie-tools">
                            <?php if ($db->is_liked($movie->id, $user->id)) { ?>
                                <a class="movie-tool active" href="/update?action=unlike&command=<?= $movie->id ?>&src=<?= urlencode($page->id) ?>" aria-label="Enlever le like" title="Enlever le like"><?php require "include/icons/heart.svg"; ?></a>
                            <?php } else { ?>
                                <a class="movie-tool" href="/update?action=like&command=<?= $movie->id ?>&src=<?= urlencode($page->id) ?>" aria-label="Mettre un like" title="Mettre un like"><?php require "include/icons/heart.svg"; ?></a>
                            <?php } ?>
                            <?php if ($db->is_watchlisted($movie->id, $user->id)) { ?>
                                <a class="movie-tool active" href="/update?action=unwatchlist&command=<?= $movie->id ?>&src=<?= urlencode($page->id) ?>" aria-label="Supprimer de votre watchlist" title="Supprimer de votre watchlist"><?php require "include/icons/done.svg"; ?></a>
                            <?php } else { ?>
                                <a class="movie-tool" href="/update?action=watchlist&command=<?= $movie->id ?>&src=<?= urlencode($page->id) ?>" aria-label="Ajouter à votre watchlist" title="Ajouter à votre watchlist"><?php require "include/icons/plus.svg"; ?></a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>