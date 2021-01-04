<?php
require_once "include/utilities.php";
$series = $db->get_series(htmlspecialchars($_GET["id"]));
if (!$series) relocate("home");
$genres = $db->get_genres($series->id);
$crew = $db->get_crew($series->id);
$cast = $db->get_cast($series->id);
$page = new Page("series?id=$series->id", "$series->title", "Découvrez la série $series->title sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <div class="background"><img class="lazyload" alt data-sizes="auto" data-src="<?= "/images/backdrops/originals/$series->id.webp"?>" /></div>
    <div class="background-header"></div>
    <?php require "include/header.php"; ?>
    <main id="main">
        <div id="presentation" class="section series-presentation">
            <div class="series-image">
                <div class="series-poster">
                    <img class="lazyload" alt data-sizes="auto" data-src="<?= "/images/posters/originals/$series->id.webp" ?>" />
                </div>
            </div>
            <div class="series-description">
                <h1 class="series-title"><?= $series->title ?></h1>
                <p class="series-info paragraph">
                    <a class="link" href="/series" aria-label="Séries">Série</a>
                    •
                    <?php
                    foreach ($genres as $genre_id => $genre) $genre_links[$genre_id] = "<a class=\"link\" href=\"genres?id=" . $genre->id . "\" aria-label=\"" . $genre->name . "\">" . $genre->name . "</a>";
                    echo implode(", ", $genre_links);
                    ?>
                </p>
                <p class="series-overview paragraph"><?= $series->overview ?></p>
            </div>
            <div class="series-details">
                <?php if (!empty($series->start_date)) { ?>
                    <div class="series-detail">
                        <h6 class="series-detail-title">Débutée le</h6>
                        <p class="series-detail-content"><?= get_date($series->start_date) ?></p>
                    </div>
                <?php } ?>
                <?php if (!empty($series->end_date)) { ?>
                    <div class="series-detail">
                        <h6 class="series-detail-title">Terminée le</h6>
                        <p class="series-detail-content"><?= get_date($series->end_date) ?></p>
                    </div>
                <?php } ?>
                <?php if (!empty($crew)) { ?>
                    <div class="series-detail">
                        <h6 class="series-detail-title">Réalisé par</h6>
                        <?php
                        foreach ($crew as $crew_id => $crew_member) $crew_links[$crew_id] = "<a class=\"link\" href=\"persons?id=" . $crew_member->id . "\" aria-label=\"" . $crew_member->name . "\">" . $crew_member->name . "</a>";
                        echo "<p class=\"series-detail-content\">", implode("<br />", $crew_links), "</p>";
                        ?>
                    </div>
                <?php } ?>
                <?php if (!empty($cast)) { ?>
                    <div class="series-detail">
                        <h6 class="series-detail-title">Avec</h6>
                        <?php
                        foreach ($cast as $cast_id => $cast_member) $cast_links[$cast_id] = "<a class=\"link\" href=\"persons?id=" . $cast_member->id . "\" aria-label=\"" . $cast_member->name . "\">" . $cast_member->name . "</a>";
                        echo "<p class=\"series-detail-content\">", implode("<br />", $cast_links), "</p>";
                        ?>
                    </div>
                <?php } ?>
                <div class="series-features">
                    <div class="series-grade">
                        <div class="series-grade-design"><?= $series->grade / 10 ?></div>
                        <p class="series-grade-help">Note des spectateurs</p>
                    </div>
                    <?php if ($db->is_connected()) { ?>
                        <div class="series-tools">
                            <?php if ($db->is_liked($series->id, $user->id)) { ?>
                                <a class="series-tool active" href="/update?action=unlike&command=<?= $series->id ?>&src=<?= urlencode($page->getID()) ?>" aria-label="Enlever le like" title="Enlever le like"><?php require "include/icons/heart.svg"; ?></a>
                            <?php } else { ?>
                                <a class="series-tool" href="/update?action=like&command=<?= $series->id ?>&src=<?= urlencode($page->getID()) ?>" aria-label="Mettre un like" title="Mettre un like"><?php require "include/icons/heart.svg"; ?></a>
                            <?php } ?>
                            <?php if ($db->is_watchlisted($series->id, $user->id)) { ?>
                                <a class="series-tool active" href="/update?action=unwatchlist&command=<?= $series->id ?>&src=<?= urlencode($page->getID()) ?>" aria-label="Supprimer de votre watchlist" title="Supprimer de votre watchlist"><?php require "include/icons/done.svg"; ?></a>
                            <?php } else { ?>
                                <a class="series-tool" href="/update?action=watchlist&command=<?= $series->id ?>&src=<?= urlencode($page->getID()) ?>" aria-label="Ajouter à votre watchlist" title="Ajouter à votre watchlist"><?php require "include/icons/plus.svg"; ?></a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>