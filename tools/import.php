<?php
require_once("database.php");
require_once("init.php");
require_once("utilities.php");

$type = htmlspecialchars($_POST["type"]);
$id = htmlspecialchars($_POST["id"]);
$tmdb = htmlspecialchars($_POST["tmdb"]);

$key = "b1b14176b6d31b632930a69cbd4b71f3";

if ($type == "series") {
    $url = "https://api.themoviedb.org/3/tv/$tmdb?api_key=$key&language=fr-FR&region=FR&append_to_response=videos";
    $data = file_get_contents($url);
    $series = json_decode($data);

    $title = $series->name;
    $rating = htmlspecialchars($_POST["rating"]);
    $start_date = $series->first_air_date;
    $end_date = $series->last_air_date;
    $genres = "";
    foreach ($series->genres as $g) {
        if ($genres != "")
            $genres .= ", ";
        $genres .= $g->name;
    }
    $grade = ($series->vote_average * 10 + htmlspecialchars($_POST["grade-imdb"]) * 10 + htmlspecialchars($_POST["grade-senscritique"]) * 10 + htmlspecialchars($_POST["grade-allocine"]) * 20) / 4;
    $synopsis = $series->overview;
    $review = htmlspecialchars($_POST["review"]);
    $poster_path = htmlspecialchars($_POST["poster_path"]);
    $backdrop_path = substr($series->backdrop_path, 1);
    $trailer_path = $series->videos->results[0]->key;

    $stmt = $db->prepare("UPDATE Series SET Title = ?, Rating = ?, StartDate = ?, EndDate = ?, Genres = ?, Grade = ?, Synopsis = ?, Review = ?, PosterPath = ?, BackdropPath = ?, TrailerPath = ?, AddDate = NOW() WHERE SeriesId = ?");
    $stmt->execute(array($title, $rating, $start_date, $end_date, $genres, $grade, $synopsis, $review, $poster_path, $backdrop_path, $trailer_path, $id));

    header("Location: /import?status=0");
    exit;
} else if ($type == "movie") {
    $url = "https://api.themoviedb.org/3/movie/$tmdb?api_key=$key&language=fr-FR&region=FR&append_to_response=videos";
    $data = file_get_contents($url);
    $movie = json_decode($data);

    $title = $movie->title;
    $rating = htmlspecialchars($_POST["rating"]);
    $release_date = $movie->release_date;
    $duration = $movie->runtime;
    $genres = "";
    foreach ($movie->genres as $g) {
        if ($genres != "")
            $genres .= ", ";
        $genres .= $g->name;
    }
    $grade = ($movie->vote_average * 10 + htmlspecialchars($_POST["grade-imdb"]) * 10 + htmlspecialchars($_POST["grade-senscritique"]) * 10 + htmlspecialchars($_POST["grade-allocine"]) * 20) / 4;
    $synopsis = $movie->overview;
    $review = htmlspecialchars($_POST["review"]);
    $poster_path = htmlspecialchars($_POST["poster_path"]);
    $backdrop_path = substr($movie->backdrop_path, 1);
    $trailer_path = $movie->videos->results[0]->key;

    $stmt = $db->prepare("UPDATE Movies SET Title = ?, Rating = ?, ReleaseDate = ?, Duration = ?, Genres = ?, Grade = ?, Synopsis = ?, Review = ?, PosterPath = ?, BackdropPath = ?, TrailerPath = ?, AddDate = NOW() WHERE MovieId = ?");
    $stmt->execute(array($title, $rating, $release_date, $duration, $genres, $grade, $synopsis, $review, $poster_path, $backdrop_path, $trailer_path, $id));

    header("Location: /import?status=0");
    exit;
} else {
    header("Location: /import?status=2");
    exit;
}
