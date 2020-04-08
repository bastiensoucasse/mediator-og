<?php
function database() {
    try {
        if ($_SERVER["HTTP_HOST"] == "localhost") $db = new PDO("mysql:host=" . $_SERVER["HTTP_HOST"] . ";dbname=Mediator;charset=utf8", "root", "BM7!me2163");
        else $db = new PDO("mysql:host=db5000329061.hosting-data.io;dbname=dbs320724;charset=utf8", "dbu183599", "BM7!io2163");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $exception) {
        die ("[ERROR] " . $exception->getMessage());
    }    
}

function minutes_to_string($minutes) {
    $hours = floor($minutes / 60);
    $minutes = $minutes % 60;
    return $hours . "h " . $minutes . "min";
}

function is_connected() {
    return isset($_SESSION["UserID"]);
}

function auth($userID) {
    $_SESSION["UserID"] = $userID;
    setcookie("UserID", $userID, time() + (86400 * 30), "/");
}

function account($userID) {
    try {
        $db = new PDO("mysql:host=db5000058251.hosting-data.io;dbname=dbs53063;charset=utf8", "dbu164195", "BM7!io2163");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $exception) {
        die ("[ERROR] " . $exception->getMessage());
    }

    $stmt = $db->prepare("SELECT * FROM `users` WHERE `id` = ?");
    $stmt->execute(array($userID));

    return $stmt->fetch();
}

function send($user, $subject, $msg) {
    $user = account($user);
    $name = $user["first_name"];
    $to = $user["first_name"] . " " . $user["last_name"] . " <" . $user["email"] . ">";

    $subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";

    $message = "Bonjour $name,<br /><br/>";
    $message .= $msg;
    $message .= "<br /><br />L'équipe de Profuder.";

    $additional_headers = array(
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html; charset=utf-8",
        "From" => "Profuder <services@profuder.com>",
        "Reply-To" => "Bastien Soucasse <bastien.soucasse@outlook.fr>",
    );
    
    $additional_parameters = null;

    return mail($to, $subject, $message, $additional_headers, $additional_parameters);
}
