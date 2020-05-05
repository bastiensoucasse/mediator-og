<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
session_start();

/**
 * Relocate to another page from its id.
 */
function relocate($id) {
    header("Location: /$id");
    exit;
}

/**
 * Get the source page of the current one.
 */
function get_source() {
    $src = strtolower(htmlspecialchars($_GET["src"]));
    if (!$src) $src = "home";
    return $src;
}

/**
 * Get the Mediator database.
 */
function get_database() {
    try {
        if ($_SERVER["HTTP_HOST"] == "localhost") $db = new PDO("mysql:host=localhost;dbname=Mediator;charset=utf8", "server", "BM7!my2163");
        else $db = new PDO("mysql:host=db5000407166.hosting-data.io;dbname=dbs389491;charset=utf8", "dbu213309", "BM7!my2163");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo "[ERROR] " . $e->getMessage() . "<br />";
        die;
    }
}

/**
 * Get a data array from some SQL.
 */
function get_all_data($sql, $args = array()) {
    $db = get_database();
    $query = $db->prepare($sql);
    $query->execute($args);
    return $query->fetchAll();
}

/**
 * Get a data row from some SQL.
 */
function get_one_data($sql, $args = array()) {
    $data = get_all_data($sql, $args);
    if (!$data || !is_array($data)) return null;
    return $data[0];
}

/**
 * Insert a row from some SQL.
 */
function post_one_data($sql, $args = array()) {
    $db = get_database();
    $query = $db->prepare($sql);
    $query->execute($args);
}

/**
 * Get a movie from its id.
 */
function get_movie($id) {
    if (!$id) return null;
    return get_one_data("SELECT * FROM `Movies` `MOV` WHERE `MOV`.`id` = ?", array($id));
}

/**
 * Get a series from its id.
 */
function get_series($id) {
    if (!$id) return null;
    return get_one_data("SELECT * FROM `Series` `SER` WHERE `SER`.`id` = ?", array($id));
}

/**
 * Get the poster string from its raw data.
 */
function get_poster($poster) {
    return "https://image.tmdb.org/t/p/original/" . $poster . ".jpg";
}

/**
 * Get the year string from its rax data.
 */
function get_year($date) {
    return substr($date, 0, 4);
}

/**
 * Get the duration string from its raw data.
 */
function get_duration($duration) {
    $hours = floor($duration / 60);
    $minutes = $duration % 60;
    if ($hours > 0 && $minutes > 0) return $hours . "h " . $minutes . "min";
    else if ($hours > 0) return $hours . "h";
    else return $minutes . "min";
}

/**
 * Get the seasons string from its raw data
 */
function get_seasons($seasons) {
    return $seasons . " saisons";
}

/**
 * Get the grade string from its raw data
 */
function get_grade($grade) {
    return $grade / 10;
}

/**
 * Get a user from its email.
 */
function get_user_from_email($email) {
    return (object) get_one_data("SELECT * FROM `Users` `USE` WHERE `USE`.`email` = ?", array($email));
}

/**
 * Get a user from its token.
 */
function get_user_from_token($token) {
    return (object) get_one_data("SELECT * FROM `Users` `USE` WHERE `USE`.`token` = ?", array($token));
}

/**
 * Generate a secure token.
 */
function generate_token($email) {
    $user = get_user_from_email($email);
    if (!$user) return null;

    $token = bin2hex(openssl_random_pseudo_bytes(16));
    post_one_data("UPDATE `Users` `USE` SET `USE`.`token` = ? WHERE `USE`.`email` = ?", array($token, $email));

    $user = get_user_from_email($email);
    if ($user->token != $token) return null;

    return $token;
}

/**
 * Connect from a token.
 */
function connect($token) {
    $_SESSION["token"] = $token;
    return $_SESSION["token"] == $token;
}

/**
 * Check if the current user is connected.
 */
function is_connected() {
    return isset($_SESSION["token"]);
}

/**
 * Log a user in from its email and password.
 */
function login($email, $password) {
    if (!$email || !$password) return false;

    $user = get_user_from_email($email);
    if (!$user) return false;

    if (!password_verify($password, $user->hash)) return false;

    $token = generate_token($email);
    if (!$token) return false;

    connect($token);
    if (!is_connected()) return false;

    setcookie("token", $token, time() + 3600 * 24 * 20, "/");
    return true;
}

/**
 * Log the current user out.
 */
function logout() {
    $_SESSION = array();
    if (is_connected()) return false;

    setcookie("token", "", time() - 3600, "/");
    return true;
}

/**
 * Sign a new user in from its data.
 */
function signin($email, $password, $first_name, $last_name) {
    if (!$email || !$password || !$first_name || !$last_name) return false;

    if (get_user_from_email($email)) return false;
    
    post_one_data("INSERT INTO `Users` (`email`, `hash`, `first_name`, `last_name`) VALUES (?, ?, ?, ?)", array($email, password_hash($password, PASSWORD_DEFAULT), $first_name, $last_name));
    return login($email, $password);
}

/**
 * Check if a command is liked by a user from their ids.
 */
function is_liked($command_id, $user_id) {
    $row = get_one_data("SELECT * FROM `Liked` `LIK` WHERE `LIK`.`command_id` = ? AND `LIK`.`user_id` = ?", array($command_id, $user_id));
    if (!$row) return false;
    return true;
}

/**
 * Check if a command is watchlisted by a user from their ids.
 */
function is_watchlisted($command_id, $user_id) {
    $row = get_one_data("SELECT * FROM `Watchlisted` `WAT` WHERE `WAT`.`command_id` = ? AND `WAT`.`user_id` = ?", array($command_id, $user_id));
    if (!$row) return false;
    return true;
}


if (!is_connected() && isset($_COOKIE["token"])) connect(htmlspecialchars($_COOKIE["token"]));

if (is_connected()) {
    $user = get_user_from_token(htmlspecialchars($_SESSION["token"]));
    if (!$user || !$user->first_name || !$user->last_name || !$user->email || !$user->avatar) {
        $user = null;
        logout();
    }
}

$queries = array(
    "novelties" => "SELECT `COM`.`id`, CONCAT(\"movies/\", `COM`.`id`) AS `link`, `COM`.`import_date`, `MOV`.`title`, `MOV`.`release_date` AS `date`, `MOV`.`grade`, `MOV`.`poster`, `MOV`.`backdrop` FROM `Commands` `COM` INNER JOIN `Movies` `MOV` ON `MOV`.`id` = `COM`.`id` WHERE `COM`.`type` = \"movie\" AND `COM`.`import_date` IS NOT NULL UNION SELECT `COM`.`id`, CONCAT(\"series/\", `COM`.`id`) AS `link`, `COM`.`import_date`, `SER`.`title`, `SER`.`start_date` AS `date`, `SER`.`grade`, `SER`.`poster`, `SER`.`backdrop` FROM `Commands` `COM` INNER JOIN `Series` `SER` ON `SER`.`id` = `COM`.`id` WHERE `COM`.`type` = \"series\" AND `COM`.`import_date` IS NOT NULL ORDER BY `import_date` DESC LIMIT 6"
);
