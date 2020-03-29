<?php
if (isset($_COOKIE["notification"]) && htmlspecialchars($_COOKIE["notification"]) != "")
{
    $n = htmlspecialchars($_COOKIE["notification"]);
    echo("<div class=\"notification\">$n</div>");

    setcookie("notification", "", time() - 3600, "/"); 
}
