<?php
require_once "utilities.php";

$db = database();

session_start();
if (!is_connected() && isset($_COOKIE["UserID"])) auth(htmlspecialchars($_COOKIE["UserID"]));

// if (is_connected())
$user = [
    "FirstName" => "Bastien",
    "LastName" => "Soucasse",
    "Email" => "bastien.soucasse@outlook.fr"
];
