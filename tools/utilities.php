<?php
function minutes_to_string($minutes)
{
    $hours = floor($minutes / 60);
    $minutes = $minutes % 60;
    return $hours . "h " . $minutes . "min";
}

function is_connected()
{
    return isset($_SESSION["id"]);
}

function auth($id)
{
    $_SESSION["id"] = $id;
}

function account($id)
{
    try {
        if ($_SERVER["HTTP_HOST"] == "mediator.profuder.com") {
            $db = new PDO("mysql:host=db5000058251.hosting-data.io;dbname=dbs53063;charset=utf8", "dbu164195", "BM7!io2163");
        } else {
            $db = new PDO("mysql:host=" . $_SERVER["HTTP_HOST"] . ";dbname=Mediator;charset=utf8", "root", "BM7!de2163");
        }
    } catch (Exception $exception) {
        die("[ERROR] " . $exception->getMessage());
    }

    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute(array($id));
    return $stmt->fetch();
}

function send($to, $subject, $message)
{
    $subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";
    $message .= "\r\n\r\nL'équipe de Profuder.\r\n";
    $additional_headers = array(
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html; charset=utf-8",
        "From" => "Profuder <services@profuder.com>",
        "Reply-To" => "Bastien Soucasse <bastien.soucasse@laposte.net>",
    );
    $additional_parameters = null;

    return mail($to, $subject, $message, $additional_headers, $additional_parameters);
}
