<?php
$page_ref = explode('/', $page["id"])[0];
if ($page_ref == "home") $nav_home_active = true;
if ($page_ref == "browse" || $page_ref == "search" || $page_ref == "movies" || $page_ref == "series" || $page_ref == "people") $nav_browse_active = true;
if ($page_ref == "library" || $page_ref == "commands") $nav_library_active = true;
?>

<header id="header">
    <div id="left-header">
        <div id="logo-banner">
            <a class="logo" href="home" aria-label="Mediator">
                <span class="logo-icon"><?php require "include/icons/stadia.svg"; ?></span>
            </a>
        </div>
        <div id="nav-banner">
            <nav id="nav">
                <a class="nav-el <?php if ($nav_home_active) echo "active"; ?>" href="home" aria-label="Accueil">
                    <span class="nav-el-icon"></span>
                    <span class="nav-el-label">Accueil</span>
                </a>
                <a class="nav-el <?php if ($nav_browse_active) echo "active"; ?>" href="browse" aria-label="Parcourir">
                    <span class="nav-el-icon"></span>
                    <span class="nav-el-label">Parcourir</span>
                </a>
                <a class="nav-el <?php if ($nav_library_active) echo "active"; ?>" href="library" aria-label="Bibliothèque">
                    <span class="nav-el-icon"></span>
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
                        <a class="account-link" href="account" aria-label="Gérer le compte">
                            <span class="account-link-icon"><?php require "include/icons/account.svg"; ?></span>
                            <span class="account-link-label">Gérer le compte</span>
                        </a>
                        <a class="account-link" href="logout" aria-label="Se déconnecter">
                            <span class="account-link-icon"><?php require "include/icons/logout.svg"; ?></span>
                            <span class="account-link-label">Se déconnecter</span>
                        </a>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div id="login-banner">
                <a class="button" href="<?= "login?src=" . $page["id"] ?>" aria-label="Se connecter">
                    <span class="button-label">Se connecter</span>
                </a>
            </div>
        <?php } ?>
    </div>
</header>
