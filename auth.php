<?php
$src = urlencode("https://" . $_SERVER["HTTP_HOST"] . "/tools" . $_SERVER["REQUEST_URI"]);
header("Location: https://account.profuder.com/auth?src=$src");
exit;
