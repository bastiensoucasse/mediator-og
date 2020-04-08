<?php
define("BASE", "https://" . $_SERVER["HTTP_HOST"] . "/preview/");
define("URI", $_PAGE["URI"]);

if (URI == "home") define("TITLE", "Mediator");
else define ("TITLE", $_PAGE["TITLE"] . " - " . "Mediator");
define("DESCRIPTION", $_PAGE["DESCRIPTION"]);
?>

<head>
    <base href="<?= BASE ?>" />

    <link rel="canonical" href="<?= BASE, URI ?>" />
    <link rel="manifest" href="manifest.json" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="style.css" />

    <meta charset="utf-8" />
    <meta name="description" content="<?= DESCRIPTION ?>" />
    <meta name="theme-color" content="#111111" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <script src="scripts/lazysizes.min.js" async></script>
    
    <title><?= TITLE ?></title>
</head>
