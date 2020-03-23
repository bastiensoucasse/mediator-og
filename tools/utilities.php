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
    setcookie("user", $id, time() + (86400 * 30), "/");
}

function account($id)
{
    try
    {
        $db = new PDO("mysql:host=db5000058251.hosting-data.io;dbname=dbs53063;charset=utf8", "dbu164195", "BM7!io2163");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $exception)
    {
        die("[ERROR] " . $exception->getMessage());
    }

    $stmt = $db->prepare("SELECT * FROM `users` WHERE `id` = ?");
    $stmt->execute(array($id));

    return $stmt->fetch();
}

function send($user, $subject, $msg)
{
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
        "Reply-To" => "Bastien Soucasse <bastien.soucasse@laposte.net>",
    );
    
    $additional_parameters = null;

    return mail($to, $subject, $message, $additional_headers, $additional_parameters);
}
