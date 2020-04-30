<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
session_start();

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
        $db = new PDO("mysql:host=localhost;dbname=Mediator;charset=utf8", "server", "BM7!my2163");
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

if (!is_connected() && isset($_COOKIE["token"])) connect(htmlspecialchars($_COOKIE["token"]));
if (is_connected()) $user = get_user_from_token(htmlspecialchars($_SESSION["token"]));
