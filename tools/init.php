<?php

require_once("utilities.php");

setlocale(LC_TIME, "fr_FR");
session_start();

if (!is_connected() && isset($_COOKIE["user"]))
{
    auth(htmlspecialchars($_COOKIE["user"]));
}
