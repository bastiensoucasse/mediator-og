<?php
require_once "include/utilities.php";

logout();
session_destroy();

header("Location: /home");
