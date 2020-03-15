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
