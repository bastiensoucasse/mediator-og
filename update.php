<?php
require_once "include/utilities.php";

$src = get_source();

$proceed = false;
$action = htmlspecialchars($_GET["action"]);
$command_id = htmlspecialchars($_GET["command"]);
if ($user && $action && $command_id) $proceed = true;

if ($proceed) {
    if ($action == "like") $db->like($user->id, $command_id);
    if ($action == "unlike") $db->unlike($user->id, $command_id);
    if ($action == "watchlist") $db->watchlist($user->id, $command_id);
    if ($action == "unwatchlist") $db->unwatchlist($user->id, $command_id);
}

relocate("$src");
