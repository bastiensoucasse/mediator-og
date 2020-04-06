<?php
if (!$credit) die ("[ERROR] A credit needs to be fetched from the TMDb.");
if (!$person_id) die ("[ERROR] A person ID has to be defined.");
if (!$type) die ("[ERROR] A type has to be defined.");
if (!$content_id) die ("[ERROR] A content ID has to be defined.");

$sql = "SELECT `CreditID` FROM `Credits` WHERE `PersonID` = ? AND `Type` = ? AND `ContentID` = ?";
$stmt = $db->prepare($sql);
$stmt->execute(array($person_id, $type, $content_id));
$c = $stmt->fetch();

if (!$c)
{
    $sql = "INSERT INTO `Credits` (`PersonID`, `Type`, `ContentID`, `Character`, `Order`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($person_id, $type, $content_id, $credit->character, $credit->order));

    $sql = "SELECT `CreditID` FROM `Credits` WHERE `PersonID` = ? AND `Type` = ? AND `ContentID` = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($person_id, $type, $content_id));
    $c = $stmt->fetch();
    if (!$c) die ("[ERROR] Could not add credit into the databse.");
}
