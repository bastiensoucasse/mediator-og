<?php
require_once "include/utilities.php";
$src = get_source();
$db->logout();
session_destroy();
relocate($src);
