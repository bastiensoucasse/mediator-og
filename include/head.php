<?php
define("PROTOCOL", isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? "https" : "http");
define("BASE", PROTOCOL . "://" . $_SERVER["HTTP_HOST"] . "/");
define("ID", $page->id);
if (ID == "home") define("TITLE", "Mediator");
else define ("TITLE", $page->name . " - " . "Mediator");
define("DESCRIPTION", $page->description);
?>
<head>
    <base href="<?= BASE ?>" />
    <link rel="canonical" href="<?= BASE . ID ?>" />
    <meta charset="utf-8" />
    <meta name="description" content="<?= DESCRIPTION ?>" />
    <meta name="theme-color" content="#202124" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style><?php require_once "include/styles/hylery.css"; ?></style>
    <style><?php require_once "include/styles/mediator.css"; ?></style>
    <title><?= TITLE ?></title>
</head>