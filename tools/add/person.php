<?php
if (!$person) die ("[ERROR] A person needs to be fetched from the TMDb.");

$sql = "SELECT `PersonID` FROM `Persons` WHERE `TMDbID` = ?";
$stmt = $db->prepare($sql);
$stmt->execute(array($person->id));
$p = $stmt->fetch();

if (!$p)
{
    $sql = "INSERT INTO `Persons` (`Name`, `Gender`, `Birthday`, `Deathday`, `Biography`, `ProfilePath`, `TMDbID`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($person->name, $person->gender, $person->birthday, $person->deathday, $person->biography, $person->profile_path, $person->id));

    $sql = "SELECT `PersonID` FROM `Persons` WHERE `TMDBID` = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($person->id));
    $p = $stmt->fetch();
    if (!$p) die ("[ERROR] Could not add person into the databse.");

    $sql = "INSERT INTO `Searches` (`Query`, `Date`) VALUES (?, NOW())";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(strtolower($person->name)));
}
