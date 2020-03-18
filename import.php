<form id="import" method="post" action="tools/import">
    <h1>Import from The Movie Database</h1>

    <input id="movie" type="radio" name="type" value="movie" required checked />
    <label for="movie">Film</label><br />
    <input id="series" type="radio" name="type" value="series" required />
    <label for="series">Série</label><br /><br />

    <label for="id">ID</label><br />
    <input id="id" type="text" name="id" min="1" required><br /><br />

    <label for="tmdb">ID TMDb</label><br />
    <input id="tmdb" type="text" name="tmdb" min="1" required><br /><br />

    <label for="rating">ID Classification</label><br />
    <input id="rating" type="text" name="rating" min="1" max="5" required><br /><br />

    <label for="grade-allocine">Note AlloCine</label><br />
    <input id="grade-allocine" type="text" name="grade-allocine" min="0" max="5" required><br /><br />

    <label for="grade-senscritique">Note SensCritique</label><br />
    <input id="grade-senscritique" type="text" name="grade-senscritique" min="0" max="10" required><br /><br />

    <label for="grade-imdb">Note IMDb</label><br />
    <input id="grade-imdb" type="text" name="grade-imdb" min="0" max="10" required><br /><br />

    <label for="poster_path">Affiche</label><br />
    <input id="poster_path" type="text" name="poster_path" required><br /><br />

    <label for="poster_path">Critique</label><br />
    <textarea id="review" name="review"></textarea><br /><br />

    <input type="submit" value="Importer" /><br />
</form>