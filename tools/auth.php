<?php

require_once("init.php");
require_once("utilities.php");

if (isset($_GET["source"]))
    $source = htmlspecialchars($_GET["source"]);
else
    $source = "/library";

auth(htmlspecialchars($_GET["id"]));

header("Location: $source");
exit;
