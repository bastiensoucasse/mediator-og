<?php
if (isset($_GET["id"])) {
    require_once("tools/init.php");
    require_once("tools/utilities.php");
    auth(htmlspecialchars($_GET["id"]));
    header("Location: /library");
    exit;
} else {
    header("Location: https://account.profuder.com/auth?src=" . urlencode("https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]));
    exit;
}
