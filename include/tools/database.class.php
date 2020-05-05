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

    // Get novelties method
    public function get_novelties() {
        $novelties = $this->get_all("SELECT `COM`.`id`, CONCAT(\"movies/\", `COM`.`id`) AS `link`, `COM`.`import_date`, `MOV`.`title`, `MOV`.`release_date` AS `date`, `MOV`.`grade`, `MOV`.`poster`, `MOV`.`backdrop` FROM `Commands` `COM` INNER JOIN `Movies` `MOV` ON `MOV`.`id` = `COM`.`id` WHERE `COM`.`type` = \"movie\" AND `COM`.`import_date` IS NOT NULL UNION SELECT `COM`.`id`, CONCAT(\"series/\", `COM`.`id`) AS `link`, `COM`.`import_date`, `SER`.`title`, `SER`.`start_date` AS `date`, `SER`.`grade`, `SER`.`poster`, `SER`.`backdrop` FROM `Commands` `COM` INNER JOIN `Series` `SER` ON `SER`.`id` = `COM`.`id` WHERE `COM`.`type` = \"series\" AND `COM`.`import_date` IS NOT NULL ORDER BY `import_date` DESC LIMIT 6");
        if (!$novelties) return null;
        function array_to_object($array) { return (object) $array; }
        return array_map("array_to_object", $novelties);
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
