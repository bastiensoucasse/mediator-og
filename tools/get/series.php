<div id="series-<?= $s["SeriesID"] ?>" class="series-container">
    <a class="series" href="/browse/series?id=<?= $s["SeriesID"] ?>" aria-label="<?= htmlspecialchars($s["Title"] . " (" . substr($s["StartDate"], 0, 4) . ")") ?>" title="<?= htmlspecialchars($s["Title"] . " (" . substr($s["StartDate"], 0, 4) . ")") ?>">
        <img class="lazyload" alt="" data-sizes="auto" data-src="<?= $img_path_1x . $s["PosterPath"] ?>" data-srcset="<?= $img_path_1x . $s["PosterPath"] ?> 1x, <?= $img_path_2x . $s["PosterPath"] ?> 2x" />
    </a>
</div>