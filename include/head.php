<?php
define("CANONICAL", "https://mediator.profuder.com/" . $page->id);
if ($page->id == "home") define("TITLE", "Mediator");
else define ("TITLE", $page->name . " - " . "Mediator");
define("DESCRIPTION", $page->description);
?>
<head>
    <link rel="canonical" href="<?= CANONICAL ?>" />
    <link rel="manifest" href="/manifest.webmanifest">
    <link rel="shortcut icon" href="/favicon.png" />
    <link rel="apple-touch-icon" href="/images/logo/mediator-192.png" />
    <meta charset="utf-8" />
    <meta name="description" content="<?= DESCRIPTION ?>" />
    <meta name="theme-color" content="#14AB95" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script><?php require_once "include/scripts/service-worker.min.js"; ?></script>
    <script><?php require_once "include/scripts/lazysizes.min.js"; ?></script>
    <style><?php require_once "include/styles/hylery.css"; ?></style>
    <style><?php require_once "include/styles/mediator.css"; ?></style>
    <title><?= TITLE ?></title>
</head>