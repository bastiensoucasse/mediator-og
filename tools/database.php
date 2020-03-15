<?php
try {
    $db = new PDO("mysql:host=127.0.0.1;dbname=Mediator;charset=utf8", "root", "BM7!de2163");
} catch (Exception $exception) {
    die("[ERROR] " . $exception->getMessage());
}
