<?php
if ($db->is_connected() && !$user) relocate("logout?src=$page->id");
define("APP_NAME", "Mediator");
define("APP_URL", "https://mediator.profuder.com");
define("APP_THEME", "#202124");
define("BASE", APP_URL . "/");
define("CANONICAL", BASE . $page->id);
if ($page->id == "home") define("TITLE", APP_NAME);
else define("TITLE", $page->name . " - " . APP_NAME);
define("DESCRIPTION", $page->description);
?>

<head>
    <!-- Missing Google site verification -->
    <base href="<?= BASE ?>" />
    <link rel="canonical" href="<?= CANONICAL ?>" />
    <link rel="home" href="/home" />
    <link rel="msapplication-starturl" href="/home" />
    <link rel="manifest" crossorigin="use-credentials" href=".webmanifest" />
    <link rel="preconnect" href="//gstatic.com">
    <link rel="preconnect" href="//fonts.gstatic.com" />
    <link rel="preconnect" href="//ssl.gstatic.com" />
    <link rel="preconnect" href="//www.gstatic.com" />
    <link rel="apple-touch-icon-precomposed" href="//ssl.gstatic.com/stadia/gamers/assets/app-icon-v2-128.png" sizes="128x128" />
    <link rel="apple-touch-icon-precomposed" href="//ssl.gstatic.com/stadia/gamers/assets/app-icon-v2-192.png" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="//ssl.gstatic.com/stadia/gamers/assets/app-icon-v2-256.png" sizes="256x256" />
    <link rel="apple-touch-icon-precomposed" href="//ssl.gstatic.com/stadia/gamers/assets/app-icon-v2-512.png" sizes="512x512" />
    <link rel="apple-touch-startup-image" href="//ssl.gstatic.com/stadia/gamers/assets/app-splash-750x1334.png" sizes="750x1334" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" />
    <link rel="apple-touch-startup-image" href="//ssl.gstatic.com/stadia/gamers/assets/app-splash-828x1792.png" sizes="828x1792" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" />
    <link rel="apple-touch-startup-image" href="//ssl.gstatic.com/stadia/gamers/assets/app-splash-1125x2436.png" sizes="1125x2436" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" />
    <link rel="apple-touch-startup-image" href="//ssl.gstatic.com/stadia/gamers/assets/app-splash-1242x2208.png" sizes="1242x2208" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3)" />
    <link rel="apple-touch-startup-image" href="//ssl.gstatic.com/stadia/gamers/assets/app-splash-1536x2048.png" sizes="1536x2048" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" />
    <link rel="apple-touch-startup-image" href="//ssl.gstatic.com/stadia/gamers/assets/app-splash-1668x2224.png" sizes="1668x2224" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" />
    <link rel="apple-touch-startup-image" href="//ssl.gstatic.com/stadia/gamers/assets/app-splash-1668x2388.png" sizes="1668x2388" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" />
    <link rel="apple-touch-startup-image" href="//ssl.gstatic.com/stadia/gamers/assets/app-splash-2048x2732.png" sizes="2048x2732" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" />
    <link rel="icon" href="//ssl.gstatic.com/stadia/gamers/assets/app-icon-v2-128.png" sizes="128x128" /> 
    <link rel="icon" href="//ssl.gstatic.com/stadia/gamers/assets/app-icon-v2-192.png" sizes="192x192" />
    <link rel="icon" href="//ssl.gstatic.com/stadia/gamers/assets/app-icon-v2-256.png" sizes="256x256" />
    <link rel="icon" href="//ssl.gstatic.com/stadia/gamers/assets/app-icon-v2-512.png" sizes="512x512" />
    <link rel="msapplication-square128x128logo" href="//ssl.gstatic.com/stadia/gamers/assets/app-icon-v2-128.png" sizes="128x128" />
    <link rel="msapplication-square192x192logo" href="//ssl.gstatic.com/stadia/gamers/assets/app-icon-v2-192.png" sizes="192x192" />
    <link rel="msapplication-square256x256logo" href="//ssl.gstatic.com/stadia/gamers/assets/app-icon-v2-256.png" sizes="256x256" />
    <link rel="msapplication-square512x512logo" href="//ssl.gstatic.com/stadia/gamers/assets/app-icon-v2-512.png" sizes="512x512" />
    <link rel="shortcut icon" href="//ssl.gstatic.com/stadia/gamers/assets/favicon.ico" />
    <link rel="stylesheet" href="//fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" />
    <meta charset="utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="<?= APP_NAME ?>" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="application-name" content="<?= APP_NAME ?>" />
    <meta name="description" content="<?= DESCRIPTION ?>" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="referer" content="origin" />
    <meta name="theme-color" content="<?= APP_THEME ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image" content="https://ssl.gstatic.com/stadia/gamers/assets/stadia_logo_and_text_v1.jpg" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width" />
    <meta property="og:image" content="https://ssl.gstatic.com/stadia/gamers/assets/stadia_logo_and_text_v1.jpg" />
    <meta property="og:url" content="<?= APP_URL ?>" />    
    <script><?php require_once "include/scripts/service-worker.min.js"; ?></script>
    <script><?php require_once "include/scripts/lazysizes.min.js"; ?></script>
    <style><?php require_once "include/styles/hylery.css"; ?></style>
    <style><?php require_once "include/styles/mediator.css"; ?></style>
    <title><?= TITLE ?></title>
</head>
