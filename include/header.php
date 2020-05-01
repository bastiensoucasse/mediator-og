<?php
$page_ref = explode('/', $page["id"])[0];
if ($page_ref == "library" || $page_ref == "commands") $nav_active = "library";
else if ($page_ref == "browse" || $page_ref == "search" || $page_ref == "movies" || $page_ref == "series" || $page_ref == "people") $nav_active = "browse";
else $nav_active = "home";
?>

<header id="header" role="banner">
    <div id="left-header">
        <div id="logo-banner">
            <a class="logo" href="home" role="link" aria-label="Mediator">
                <span class="logo-icon"><?php include "include/icons/stadia.svg"; ?></span>
            </a>
        </div>
        <div id="nav-banner">
            <nav id="nav" role="navigation">
                <a class="nav-el <?php if ($nav_active == "home") echo "active"; ?>" href="home" role="link" aria-label="Accueil">
                    <span class="nav-el-icon"><?php include "include/icons/home.svg"; ?></span>
                    <span class="nav-el-label">Accueil</span>
                </a>
                <a class="nav-el <?php if ($nav_active == "browse") echo "active"; ?>" href="browse" role="link" aria-label="Parcourir">
                    <span class="nav-el-icon"><?php include "include/icons/browse.svg"; ?></span>
                    <span class="nav-el-label">Parcourir</span>
                </a>
                <a class="nav-el <?php if ($nav_active == "library") echo "active"; ?>" href="library" role="link" aria-label="Bibliothèque">
                    <span class="nav-el-icon"><?php include "include/icons/library.svg"; ?></span>
                    <span class="nav-el-label">Bibliothèque</span>
                </a>
            </nav>
        </div>
    </div>
    <div id="right-header">
        <?php if (is_connected()) { ?>
            <div id="account-overview">
                <div id="account-banner">
                    <div id="account-name"><?= $user->first_name ?></div>
                    <div id="account-avatar"><img alt src="<?= $user->avatar ?>" /></div>
                </div>
                <div id="account">
                    <div id="account-links">
                        <a class="account-link" href="account" role="link" aria-label="Gérer le compte">
                            <span class="account-link-icon"><?php include "include/icons/account.svg"; ?></span>
                            <span class="account-link-label">Gérer le compte</span>
                        </a>
                        <a class="account-link" href="logout" role="link" aria-label="Se déconnecter">
                            <span class="account-link-icon"><?php include "include/icons/logout.svg"; ?></span>
                            <span class="account-link-label">Se déconnecter</span>
                        </a>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div id="login-banner">
                <a class="button" href="<?= "login?src=" . $page["id"] ?>" role="link" aria-label="Se connecter">
                    <span class="button-label">Se connecter</span>
                </a>
            </div>
        <?php } ?>
    </div>
</header>
