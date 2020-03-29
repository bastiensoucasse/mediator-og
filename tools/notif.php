<?php
if (isset($_COOKIE["notification"]))
{
    $n = htmlspecialchars($_COOKIE["notification"]);
    include("get/notif.php");
    setcookie("notification", "", time() - 3600);
}
