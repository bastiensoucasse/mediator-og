<div id="movie-<?= $m["MovieID"] ?>" class="movie-container">
    <a class="movie" href="/browse/movies?id=<?= $m["MovieID"] ?>" aria-label="<?= htmlspecialchars($m["Title"] . " (" . substr($m["ReleaseDate"], 0, 4) . ")") ?>" title="<?= htmlspecialchars($m["Title"] . " (" . substr($m["ReleaseDate"], 0, 4) . ")") ?>">
        <img class="lazyload" alt="" data-sizes="auto" data-src="<?= $img_path_1x . $m["PosterPath"] ?>" data-srcset="<?= $img_path_1x . $m["PosterPath"] ?> 1x, <?= $img_path_2x . $m["PosterPath"] ?> 2x" />
    </a>
</div>