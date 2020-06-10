<?php
require_once "include/utilities.php";
if (!$db->is_connected()) die("Vous devez être connectés.");
$src = get_source();
$page = new Page("account", "Compte", "Gérez votre compte Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <?php require "include/header.php"; ?>
    <main id="main">
        <div id="account-page" class="section limited">
            <h2 class="section-title">Compte</h2>
            <div class="form">
                <h3>Bienvenue <?= $user->first_name ?>,</h3>
                <div class="account-tools">
                    <p class="paragraph"><?= $user->first_name . " " . $user->last_name ?><a class="link account-action" href="/change-name" aria-label="Modifier le nom" style="user-select: none;">Modifier le nom</a></p>
                    <p class="paragraph"><?= $user->email ?><a class="link account-action" href="/change-email" aria-label="Modifier l'e-mail" style="user-select: none;">Modifier l'e-mail</a></p>
                    <p class="paragraph">********<a class="link account-action" href="/change-password" aria-label="Modifier le mot de passe" style="user-select: none;">Modifier le mot de passe</a></p>
                </div>
                <div class="account-tools">
                    <p class="paragraph"><a class="link account-action" href="/orders" aria-label="Consulter vos commandes" style="user-select: none;">Consulter vos commandes</a></p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>