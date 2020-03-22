<?php
try {
    if ($_SERVER["HTTP_HOST"] == "mediator.profuder.com") {
        $db = new PDO("mysql:host=db5000329061.hosting-data.io;dbname=dbs320724;charset=utf8", "dbu183599", "BM7!io2163");
    } else {
        $db = new PDO("mysql:host=" . $_SERVER["HTTP_HOST"] . ";dbname=Mediator;charset=utf8", "server", "BM7!de2163");
    }
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $exception) {
    die("[ERROR] " . $exception->getMessage());
}
