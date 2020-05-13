<?php
/**
 * Database class
 */
class Database {
    // PDO attribute
    private $pdo;

    // Post primitive
    private function post($sql, $parameters = array()) {
        if (!$sql) return null;
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
    }

    // Get one primitive
    private function get_one($sql, $parameters = array()) {
        if (!$sql) return null;
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query->fetch();
    }

    // Get all primitive
    private function get_all($sql, $parameters = array()) {
        if (!$sql) return null;
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    // Convert to objects primitive
    private function convert_to_objects($array) {
        foreach ($array as $key => $element) $array[$key] = (object) $element;
        return $array;
    }

    // Download images privitive
    private function download_images($id, $tmdb_image_id, $type) {
        if (!$id || !$tmdb_image_id || !$type) return false;
        if ($type == "backdrop" || $type == "tile") $sizes = array("original", 840);
        else if ($type == "person" || $type == "poster") $sizes = array("original", 360);
        else return false;
        foreach ($sizes as $size) {
            if ($size == "original") { $img = imagecreatefromjpeg("https://image.tmdb.org/t/p/original/$tmdb_image_id.jpg"); $path = "images/" . $type . "s/originals/" . $id . ".webp"; }
            else { $img = imagescale(imagecreatefromjpeg("https://image.tmdb.org/t/p/original/$tmdb_image_id.jpg"), $size);$path = "images/" . $type . "s/x" . $size . "/" . $id . ".webp"; }
            imagepalettetotruecolor($img);
            imagealphablending($img, true);
            imagesavealpha($img, true);
            imagewebp($img, $path, 100);
            imagedestroy($img);
        }
        return true;
    }

    // Get user from email privitive
    private function get_user_from_email($email) {
        if (!$email) return null;
        $user = $this->get_one("SELECT * FROM `Users` `USE` WHERE `USE`.`email` = ?", array($email));
        if (!$user) return null;
        return (object) $user;
    }

    // Get user from token primitive
    private function get_user_from_token($token) {
        if (!$token) return null;
        $user = $this->get_one("SELECT * FROM `Users` `USE` WHERE `USE`.`token` = ?", array($token));
        if (!$user) return null;
        return (object) $user;
    }

    // Generate token primitive
    private function generate_token($email) {
        if (!$email) return null;
        $user = $this->get_user_from_email($email);
        if (!$user) return null;
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        $this->post("UPDATE `Users` `USE` SET `USE`.`token` = ? WHERE `USE`.`email` = ?", array($token, $email));
        $user = $this->get_user_from_email($email);
        if (!$user || $user->token != $token) return null;
        return $token;
    }

    // Is connected method
    public function is_connected() {
        return isset($_SESSION["token"]);
    }

    // Get connected user method
    public function get_connected_user() {
        if (!$this->is_connected()) return null;
        return $this->get_user_from_token(htmlspecialchars($_SESSION["token"]));
    }

    // Connect method
    public function connect($token) {
        if (!$token) return null;
        $_SESSION["token"] = $token;
        if (!$this->is_connected()) return null;
        setcookie("token", $token, time() + 3600 * 24 * 20, "/");
        return $this->get_user_from_token($token);
    }

    // Login method
    public function login($email, $password) {
        if (!$email || !$password) return null;
        $user = $this->get_user_from_email($email);
        if (!$user) return null;
        if (!password_verify($password, $user->hash)) return null;
        $token = $this->generate_token($email);
        if (!$token) return null;
        return $this->connect($token);
    }

    // Signin method
    public function signin($email, $password, $first_name, $last_name) {
        if (!$email || !$password || !$first_name || !$last_name) return null;
        if ($this->get_user_from_email($email)) return null;
        $this->post("INSERT INTO `Users` (`email`, `hash`, `first_name`, `last_name`) VALUES (?, ?, ?, ?)", array($email, password_hash($password, PASSWORD_DEFAULT), $first_name, $last_name));
        return $this->login($email, $password);
    }

    // Logout method
    public function logout() {
        $_SESSION = array();
        setcookie("token", "", time() - 3600, "/");
    }

    // Get command method
    public function get_command($command_id) {
        if (!$command_id) return null;
        $command = $this->get_one("SELECT * FROM `Commands` `COM` WHERE `COM`.`id` = ?", array($command_id));
        if (!$command) return null;
        return (object) $command;
    }

    // Get movie method
    public function get_movie($movie_id) {
        if (!$movie_id) return null;
        $movie = $this->get_one("SELECT * FROM `Movies` `MOV` WHERE `MOV`.`id` = ?", array($movie_id));
        if (!$movie) return null;
        return (object) $movie;
    }

    // Get series method
    public function get_series($series_id) {
        if (!$series_id) return null;
        $series = $this->get_one("SELECT * FROM `Series` `SER` WHERE `SER`.`id` = ?", array($series_id));
        if (!$series) return null;
        return (object) $series;
    }

    // Get genre method
    public function get_genre($genre_id) {
        if (!$genre_id) return null;
        $genre = $this->get_one("SELECT * FROM `Genres` `GEN` WHERE `GEN`.`id` = ?", array($genre_id));
        if (!$genre) return null;
        return (object) $genre;
    }

    // Get person method
    public function get_person($person_id) {
        if (!$person_id) return null;
        $person = $this->get_one("SELECT * FROM `Persons` `GEN` WHERE `GEN`.`id` = ?", array($person_id));
        if (!$person) return null;
        return (object) $person;
    }

    // Is liked method
    public function is_liked($command_id, $user_id) {
        if (!$command_id || !$user_id) return false;
        $row = $this->get_one("SELECT * FROM `Liked` `LIK` WHERE `LIK`.`command_id` = ? AND `LIK`.`user_id` = ?", array($command_id, $user_id));
        if (!$row) return false;
        return true;
    }

    // Is watchlisted method
    public function is_watchlisted($command_id, $user_id) {
        if (!$command_id || !$user_id) return false;
        $row = $this->get_one("SELECT * FROM `Watchlisted` `WAT` WHERE `WAT`.`command_id` = ? AND `WAT`.`user_id` = ?", array($command_id, $user_id));
        if (!$row) return false;
        return true;
    }

    // Get genres method
    public function get_genres($command_id) {
        if (!$command_id) return null;
        $genres = $this->get_all("SELECT `GEN`.`id`, `GEN`.`name` FROM `HasGenre` `HAS` INNER JOIN `Genres` `GEN` ON `HAS`.`genre_id` = `GEN`.`id` WHERE `HAS`.`command_id` = ?", array($command_id));
        if (!$genres) return null;
        return $this->convert_to_objects($genres);
    }

    // Get crew method
    public function get_crew($command_id) {
        if (!$command_id) return null;
        $crew_member = $this->get_all("SELECT `PER`.`id`, `PER`.`name`, `CRE`.`job` FROM `Crew` `CRE` INNER JOIN `Persons` `PER` ON `CRE`.`person_id` = `PER`.`id` WHERE `CRE`.`command_id` = ?", array($command_id));
        if (!$crew_member) return null;
        return $this->convert_to_objects($crew_member);
    }

    // Get best method
    public function get_best($limited = false) {
        $sql = "SELECT `COM`.`id`, CONCAT('movies/', `COM`.`id`) AS `link`, `MOV`.`title`, `MOV`.`grade`, `MOV`.`release_date` AS `date`, `COM`.`import_date`
                FROM `Commands` `COM`
                INNER JOIN `Movies` `MOV` ON `MOV`.`id` = `COM`.`id`
                WHERE `COM`.`type` = 'movie'
                AND `COM`.`import_date` IS NOT NULL
                UNION
                SELECT `COM`.`id`, CONCAT('series/', `COM`.`id`) AS `link`, `SER`.`title`, `SER`.`grade`, `SER`.`start_date` AS `date`, `COM`.`import_date`
                FROM `Commands` `COM`
                INNER JOIN `Series` `SER` ON `SER`.`id` = `COM`.`id`
                WHERE `COM`.`type` = 'series'
                AND `COM`.`import_date` IS NOT NULL
                ORDER BY `grade` DESC";
        if ($limited) $sql .= " LIMIT 6";
        $best = $this->get_all($sql);
        if (!$best) return null;
        return $this->convert_to_objects($best);
    }

    // Get novelties method
    public function get_novelties($limited = false) {
        $sql = "SELECT `COM`.`id`, CONCAT('movies/', `COM`.`id`) AS `link`, `MOV`.`title`, `MOV`.`grade`, `MOV`.`release_date` AS `date`, `COM`.`import_date`
                FROM `Commands` `COM`
                INNER JOIN `Movies` `MOV` ON `MOV`.`id` = `COM`.`id`
                WHERE `COM`.`type` = 'movie'
                AND `COM`.`import_date` IS NOT NULL
                UNION
                SELECT `COM`.`id`, CONCAT('series/', `COM`.`id`) AS `link`, `SER`.`title`, `SER`.`grade`, `SER`.`start_date` AS `date`, `COM`.`import_date`
                FROM `Commands` `COM`
                INNER JOIN `Series` `SER` ON `SER`.`id` = `COM`.`id`
                WHERE `COM`.`type` = 'series'
                AND `COM`.`import_date` IS NOT NULL
                ORDER BY `import_date` DESC";
        if ($limited) $sql .= " LIMIT 6";
        $novelties = $this->get_all($sql);
        if (!$novelties) return null;
        return $this->convert_to_objects($novelties);
    }

    // Get of genre method
    public function get_of_genre($genre_id, $limited = false) {
        if (!$genre_id) return null;
        $sql = "SELECT `COM`.`id`, CONCAT('movies/', `COM`.`id`) AS `link`, `MOV`.`title`, `MOV`.`grade`, `MOV`.`release_date` AS `date`, `COM`.`import_date`
                FROM `Commands` `COM`
                INNER JOIN `Movies` `MOV` ON `MOV`.`id` = `COM`.`id`
                INNER JOIN `HasGenre` `HAS` ON `HAS`.`command_id` = `COM`.`id`
                WHERE `HAS`.`genre_id` = :genre_id
                AND `COM`.`type` = 'movie'
                AND `COM`.`import_date` IS NOT NULL
                UNION
                SELECT `COM`.`id`, CONCAT('series/', `COM`.`id`) AS `link`, `SER`.`title`, `SER`.`grade`, `SER`.`start_date` AS `date`, `COM`.`import_date`
                FROM `Commands` `COM`
                INNER JOIN `Series` `SER` ON `SER`.`id` = `COM`.`id`
                INNER JOIN `HasGenre` `HAS` ON `HAS`.`command_id` = `COM`.`id`
                WHERE `HAS`.`genre_id` = :genre_id
                AND `COM`.`type` = 'series'
                AND `COM`.`import_date` IS NOT NULL
                ORDER BY `import_date` DESC";
        if ($limited) $sql .= " LIMIT 6";
        $parameters = array("genre_id" => $genre_id);
        $of_genre = $this->get_all($sql, $parameters);
        if (!$of_genre) return null;
        return $this->convert_to_objects($of_genre);
    }

    // Get watchlisted method
    public function get_watchlisted($user_id, $limited = false) {
        if (!$user_id) return null;
        $sql = "SELECT `COM`.`id`, CONCAT('movies/', `COM`.`id`) AS `link`, `MOV`.`title`, `MOV`.`grade`, `MOV`.`release_date` AS `date`, `COM`.`import_date`
                FROM `Commands` `COM`
                INNER JOIN `Movies` `MOV` ON `MOV`.`id` = `COM`.`id`
                INNER JOIN `Watchlisted` `WAT` ON `WAT`.`command_id` = `COM`.`id`
                WHERE `WAT`.`user_id` = :user_id
                AND `COM`.`type` = 'movie'
                AND `COM`.`import_date` IS NOT NULL
                UNION
                SELECT `COM`.`id`, CONCAT('series/', `COM`.`id`) AS `link`, `SER`.`title`, `SER`.`grade`, `SER`.`start_date` AS `date`, `COM`.`import_date`
                FROM `Commands` `COM`
                INNER JOIN `Series` `SER` ON `SER`.`id` = `COM`.`id`
                INNER JOIN `Watchlisted` `WAT` ON `WAT`.`command_id` = `COM`.`id`
                WHERE `WAT`.`user_id` = :user_id
                AND `COM`.`type` = 'series'
                AND `COM`.`import_date` IS NOT NULL
                ORDER BY `import_date` DESC";
        if ($limited) $sql .= " LIMIT 6";
        $parameters = array("user_id" => $user_id);
        $watchlisted = $this->get_all($sql, $parameters);
        if (!$watchlisted) return null;
        return $this->convert_to_objects($watchlisted);
    }

    // Get liked method
    public function get_liked($user_id, $limited = false) {
        if (!$user_id) return null;
        $sql = "SELECT `COM`.`id`, CONCAT('movies/', `COM`.`id`) AS `link`, `MOV`.`title`, `MOV`.`grade`, `MOV`.`release_date` AS `date`, `COM`.`import_date`
                FROM `Commands` `COM`
                INNER JOIN `Movies` `MOV` ON `MOV`.`id` = `COM`.`id`
                INNER JOIN `Liked` `LIK` ON `LIK`.`command_id` = `COM`.`id`
                WHERE `LIK`.`user_id` = :user_id
                AND `COM`.`type` = 'movie'
                AND `COM`.`import_date` IS NOT NULL
                UNION
                SELECT `COM`.`id`, CONCAT('series/', `COM`.`id`) AS `link`, `SER`.`title`, `SER`.`grade`, `SER`.`start_date` AS `date`, `COM`.`import_date`
                FROM `Commands` `COM`
                INNER JOIN `Series` `SER` ON `SER`.`id` = `COM`.`id`
                INNER JOIN `Liked` `LIK` ON `LIK`.`command_id` = `COM`.`id`
                WHERE `LIK`.`user_id` = :user_id
                AND `COM`.`type` = 'series'
                AND `COM`.`import_date` IS NOT NULL
                ORDER BY `import_date` DESC";
        if ($limited) $sql .= " LIMIT 6";
        $parameters = array("user_id" => $user_id);
        $liked = $this->get_all($sql, $parameters);
        if (!$liked) return null;
        return $this->convert_to_objects($liked);
    }

    // Import method
    public function import($command_id, $tmdb_id, $poster, $tile, $backdrop) {
        function translate($text, $src_lang = "en", $dest_lang = "fr") {
            $json = json_decode(file_get_contents("https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20200513T092948Z.1481a214a2520e19.2d34476634e7ee60f08a74fd64d8af63dc0a0335&text=" . urlencode($text) . "&lang=$src_lang-$dest_lang"));
            return $json->text[0];
        }
        function convert_status($status) {
            $correspondances = array("Released" => "Sorti", "Returning Series" => "En cours", "Ended" => "Terminée", "Cancelled" => "Annulée");
            $string = $correspondances[$status];
            if (!$string) return ucfirst(translate(strtolower($status)));
            return $string;
        }
        $tmdb_api_key = "b1b14176b6d31b632930a69cbd4b71f3";
        if (!$command_id || !$tmdb_id || !$poster || !$tile || !$backdrop) return false;
        $command = $this->get_command($command_id);
        if (!$command) return false;
        $type = $command->type;
        if ($type == "series") $type = "tv";
        $tmdb_data = json_decode(file_get_contents("https://api.themoviedb.org/3/$type/$tmdb_id?api_key=$tmdb_api_key&language=fr-FR&region=FR&append_to_response=credits,images,videos"));
        if (!$tmdb_data) return false;
        if ($command->type == "series") $this->post("DELETE FROM `Series` `SER` WHERE `SER`.`id` = ?; INSERT INTO `Series`(`id`, `title`, `grade`, `start_date`, `end_date`, `seasons`, `episodes`, `status`, `original_language`, `original_title`, `overview`, `video`, `tmdb_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array($command->id, $command->id, $tmdb_data->name, $tmdb_data->vote_average * 10, $tmdb_data->first_air_date, $tmdb_data->status == "Returning Series" ? null : $tmdb_data->last_air_date, $tmdb_data->number_of_seasons, $tmdb_data->number_of_episodes, convert_status($tmdb_data->status), $tmdb_data->original_language, $tmdb_data->original_name, $tmdb_data->overview, $tmdb_data->videos->results[0]->key, $tmdb_data->id));
        else if ($command->type == "movie") $this->post("DELETE FROM `Movies` `MOV` WHERE `MOV`.`id` = ?; INSERT INTO `Movies`(`id`, `title`, `grade`, `release_date`, `duration`, `status`, `original_language`, `original_title`, `overview`, `video`, `tmdb_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array($command->id, $command->id, $tmdb_data->title, $tmdb_data->vote_average * 10, $tmdb_data->release_date, $tmdb_data->runtime,  convert_status($tmdb_data->status), $tmdb_data->original_language, $tmdb_data->original_title, $tmdb_data->overview, $tmdb_data->videos->results[0]->key, $tmdb_data->id));
        else return false;
        if (!$this->download_images($command->id, $poster, "poster")) return false;
        if (!$this->download_images($command->id, $tile, "tile")) return false;
        if (!$this->download_images($command->id, $backdrop, "backdrop")) return false;
        foreach ($tmdb_data->genres as $genre) {
            if (!$this->get_genre($genre->id)) $this->post("INSERT INTO `Genres` VALUES (?, ?)", array($genre->id, $genre->name));
            if (!$this->get_one("SELECT * FROM `HasGenre` `HAS` WHERE `HAS`.`command_id` = ? AND `HAS`.`genre_id` = ?", array($command->id, $genre->id)))
                $this->post("INSERT INTO `HasGenre` (`command_id`, `genre_id`) VALUES (?, ?)", array($command->id, $genre->id));
        }
        $i = 0;
        foreach ($tmdb_data->credits->cast as $cast) {
            $i++;
            if ($i > 8) break;
            if (!$this->get_person($cast->id)) {
                $person = json_decode(file_get_contents("https://api.themoviedb.org/3/person/$cast->id?api_key=$tmdb_api_key&language=fr-FR&region=FR"));
                $this->post("INSERT INTO `Persons` VALUES (?, ?, ?, ?, ?)", array($person->id, $person->name, $person->birthday, $person->deathday, $person->biography));
                $this->download_images($person->id, substr($person->profile_path, 0, -4), "person");
            }
            if (!$this->get_one("SELECT * FROM `Cast` `CAS` WHERE `CAS`.`command_id` = ? AND `CAS`.`person_id` = ?", array($command->id, $cast->id)))
                $this->post("INSERT INTO `Cast` (`command_id`, `person_id`, `character`) VALUES (?, ?, ?)", array($command->id, $cast->id, $cast->character));
        }
        if ($command->type == "series") {
            foreach ($tmdb_data->created_by as $crew) {
                if (!$this->get_person($crew->id)) {
                    $person = json_decode(file_get_contents("https://api.themoviedb.org/3/person/$crew->id?api_key=$tmdb_api_key&language=fr-FR&region=FR"));
                    $this->post("INSERT INTO `Persons` VALUES (?, ?, ?, ?, ?)", array($person->id, $person->name, $person->birthday, $person->deathday, $person->biography));
                    $this->download_images($person->id, substr($person->profile_path, 0, -4), "person");
                }
                if (!$this->get_one("SELECT * FROM `Crew` `CRE` WHERE `CRE`.`command_id` = ? AND `CRE`.`person_id` = ?", array($command->id, $crew->id)))
                    $this->post("INSERT INTO `Crew` (`command_id`, `person_id`, `job`) VALUES (?, ?, ?)", array($command->id, $crew->id, "Créateur"));
            }
        }
        if ($command->type == "movie") {
            $jobs = array("Director" => "Réalisateur", "Producer" => "Producteur", "Writer" => "Scénariste");
            foreach ($tmdb_data->credits->crew as $crew) {
                if (in_array($crew->job, array_keys($jobs))) {
                    if (!$this->get_person($crew->id)) {
                        $person = json_decode(file_get_contents("https://api.themoviedb.org/3/person/$crew->id?api_key=$tmdb_api_key&language=fr-FR&region=FR"));
                        $this->post("INSERT INTO `Persons` VALUES (?, ?, ?, ?, ?)", array($person->id, $person->name, $person->birthday, $person->deathday, $person->biography));
                        $this->download_images($person->id, substr($person->profile_path, 0, -4), "person");
                    }
                    if (!$this->get_one("SELECT * FROM `Crew` `CRE` WHERE `CRE`.`command_id` = ? AND `CRE`.`person_id` = ?", array($command->id, $crew->id)))
                        $this->post("INSERT INTO `Crew` (`command_id`, `person_id`, `job`) VALUES (?, ?, ?)", array($command->id, $crew->id, $jobs[$crew->job]));
                }
            }
        }
        $this->post("UPDATE `Commands` `COM` SET `COM`.`import_date` = CURRENT_TIME() WHERE `COM`.`id` = ?", array($command->id));
        return true;
    }

    // Constructor
    public function __construct() {
        try {
            if ($_SERVER["HTTP_HOST"] == "localhost") $this->pdo = new PDO("mysql:host=localhost;dbname=Mediator;charset=utf8", "server", "BM7!my2163");
            else $this->pdo = new PDO("mysql:host=db5000407166.hosting-data.io;dbname=dbs389491;charset=utf8", "dbu213309", "BM7!my2163");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die ("[ERROR] " . $e->getMessage() . "<br />");
        }
    }
}
