<?php
require_once "include/utilities.php";
$src = get_source();
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = strtolower(htmlspecialchars($_POST["email"]));
    $password = htmlspecialchars($_POST["password"]);
    if (!$db->login($email, $password)) relocate("login?src=" . urlencode($src));
    relocate($src);
}
$page = new Page("login", "Se connecter", "Connectez-vous à votre compte Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <main id="main" class="fullscreen">
        <form id="login" class="section limited form" action="login?src=<?= $src ?>" method="post">
            <a class="logo" href="/home" aria-label="Mediator">
                <span class="logo-icon"><?php require "include/icons/stadia.svg"; ?></span>
            </a>
            <h3>Identifiez-vous avec votre adresse e-mail</h3>
            <input type="email" class="text-input" name="email" aria-label="Adresse e-mail" placeholder="Adresse e-mail" required />
            <input type="password" class="text-input" name="password" aria-label="Mot de passe" placeholder="Mot de passe" required />
            <input type="submit" class="button" aria-label="Se connecter" value="Se connecter" />
            <p class="paragraph">Nouveau sur Mediator ? <a class="link" href="<?= "/signin?src=" . urlencode($src) ?>" aria-label="S'inscrire">S'inscrire</a></p>
        </form>
    </main>
</body>

</html>