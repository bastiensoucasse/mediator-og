<?php
require_once "include/utilities.php";
$src = get_source();
if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["first_name"]) && isset($_POST["last_name"])) {
    $email = strtolower(htmlspecialchars($_POST["email"]));
    $password = htmlspecialchars($_POST["password"]);
    $first_name = ucwords(htmlspecialchars($_POST["first_name"]));
    $last_name = ucwords(htmlspecialchars($_POST["last_name"]));
    if (!$db->signin($email, $password, $first_name, $last_name)) relocate("signin?src=" . urlencode($src));
    relocate($src);
}
$page = new Page("signin", "S'inscrire", "Inscrivez-vous sur Mediator pour personnaliser votre expérience et accéder à encore plus de fonctionnalités.");
?>
<!doctype html>
<html lang="fr-fr">
    <?php require "include/head.php"; ?>
    <body>
        <main id="main" class="fullscreen">
            <form id="signin" class="form" action="signin" method="post">
                <a class="logo" href="home" aria-label="Mediator">
                    <span class="logo-icon"><?php require "include/icons/stadia.svg"; ?></span>
                </a>
                <h3>Inscrivez-vous avec votre adresse e-mail</h3>
                <input type="text" class="text-input" name="first_name" aria-label="Prénom" placeholder="Prénom" required />
                <input type="text" class="text-input" name="last_name" aria-label="Nom" placeholder="Nom" required />
                <input type="email" class="text-input" name="email" aria-label="Adresse e-mail" placeholder="Adresse e-mail" required />
                <input type="password" class="text-input" name="password" aria-label="Mot de passe" placeholder="Mot de passe" required />
                <input type="submit" class="button" aria-label="S'inscrire" value="S'inscrire" />
                <p>Vous avez déjà un compte ? <a class="link" href="<?= "login?src=" . urlencode($src) ?>" aria-label="Se connecter">Se connecter</a></p>
            </form>
        </main>
    </body>
</html>