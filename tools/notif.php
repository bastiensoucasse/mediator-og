<?php
if (isset($_COOKIE["notification"]))
{
    setcookie("notification", "", time() - 3600, "/");
    $n = htmlspecialchars($_COOKIE["notification"]);
    echo("<div class=\"notification\">$n</div>");
}
