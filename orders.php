<?php
require_once "include/utilities.php";
if (!$db->is_connected()) die("Vous devez être connectés.");
$orders = $db->get_commands($user->id, true);
$src = get_source();
$page = new Page("orders", "Commandes", "Consultez vos commandes sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <?php require "include/header.php"; ?>
    <main id="main">
        <div id="account-page" class="section limited">
            <h2 class="section-title">Commandes</h2>
            <?php if (empty($orders)) { ?>
                <div class="section-content">
                    <p class="paragraph limited">Vous n'avez effectué aucune commande.</p>
                </div>
            <?php } else { ?>
                <div class="section-content order-list">
                    <?php foreach ($orders as $order) require "include/order.php"; ?>
                </div>
            <?php } ?>
        </div>
    </main>
</body>

</html>