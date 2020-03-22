<?php
require_once("../tools/init.php");
require_once("../tools/utilities.php");

if (isset($_GET["id"]))
{
    if (isset($_GET["source"]))
        $source = htmlspecialchars($_GET["source"]);
    else
        $source = "/library";

    auth(htmlspecialchars($_GET["id"]));

    header("Location: $source");
    exit;
}
else
{
    header("Location: https://account.profuder.com/auth?src=" . urlencode("https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]));
    exit;
}
