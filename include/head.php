<?php
require_once "tools/page.class.php";

if ($db->is_connected() && !$user) relocate("logout?src=$page->id");

define("NAME", "Mediator");
define("DESCRIPTION", "Mediator est la base cinématographique de Profuder. Trouvez des informations sur les derniers films, séries et célébrités.");
define("SERVER", "mediator.profuder.com");

define("PROTOCOL", isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off" ? "https" : "http");
define("DOMAIN", $_SERVER["SERVER_NAME"]);

define("BASE", PROTOCOL . "://" . DOMAIN);
define("CANONICAL", "https://" . SERVER);

define("PAGE", substr($_SERVER["REQUEST_URI"], 1));

if (!isset($page))
    $page = new Page(PAGE, NAME, DESCRIPTION);

$iconSizes = array("128", "192", "256", "512", "1024");
$iconTypes = array("png", "webp");
?>

<head>
    <base href="<?= BASE ?>">
    <link rel="home" href="home">
    <link rel="manifest" crossorigin="use-credentials" href="manifest.webmanifest">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500&display=swap" crossorigin="anonymous" onload="this.rel=`stylesheet`">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    <?php
    foreach ($iconSizes as $s)
    {
        foreach ($iconTypes as $t)
        {
            $h = "assets/images/icons/mediator-${s}.${t}";
            echo("<link rel=\"icon\" sizes=\"${s}x${s}\" type=\"image/${t}\" href=\"$h\">");

            $h = "assets/images/icons/mediator-${s}-maskable.${t}";
            foreach (array("apple-touch-icon", "msapplication-square${s}x${s}logo") as $r)
                echo("<link rel=\"${r}\" sizes=\"${s}x${s}\" type=\"image/${t}\" href=\"$h\">");
        } 
    }
    ?>
    <meta charset="utf-8">
    <meta name="canonical" content="<?= CANONICAL . "/" . $page->getID() ?>">
    <meta name="description" content="<?= $page->getDescription(); ?>">
    <meta name="referer" content="origin">
    <meta name="theme-color" content="#202124">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <script><?php require "scripts/lazysizes.min.js"; ?></script>
    <script><?php require "scripts/mediator.min.js"; ?></script>
    <style><?php require "styles/mediator.min.css"; ?></style>
    <title><?= $page->getName() == NAME | $page->getID() == "home" ? NAME : $page->getName() . " - " . NAME ?></title>
</head>
