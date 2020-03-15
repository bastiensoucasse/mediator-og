<?php
function minutesToString($minutes)
{
    $hours = floor($minutes / 60);
    $minutes = $minutes % 60;
    return $hours . "h " . $minutes . "min";
}
