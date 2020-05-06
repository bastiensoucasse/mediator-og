<?php
$page_ref = explode('/', $page->id)[0];
if ($page_ref == "library" || $page_ref == "commands") $nav_active = "library";
else if ($page_ref == "browse" || $page_ref == "search" || $page_ref == "movies" || $page_ref == "series" || $page_ref == "genres" || $page_ref == "persons") $nav_active = "browse";
else $nav_active = "home";
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
                <a class="nav-el <?php if ($nav_active == "home") echo "active"; ?>" href="home" aria-label="Accueil">
                    <span class="nav-el-icon"><?php require "include/icons/home.svg"; ?></span>
                    <span class="nav-el-label">Accueil</span>
                </a>
                <a class="nav-el <?php if ($nav_active == "browse") echo "active"; ?>" href="browse" aria-label="Parcourir">
                    <span class="nav-el-icon"><?php require "include/icons/browse.svg"; ?></span>
                    <span class="nav-el-label">Parcourir</span>
                </a>
                <a class="nav-el <?php if ($nav_active == "library") echo "active"; ?>" href="library" aria-label="Bibliothèque">
                    <span class="nav-el-icon"><?php require "include/icons/library.svg"; ?></span>
                    <span class="nav-el-label">Bibliothèque</span>
                </a>
            </nav>
        </div>
    </div>
    <div id="right-header">
        <?php if ($db->is_connected()) { ?>
            <div id="account-overview">
                <div id="account-banner">
                    <div id="account-name"><?= $user->first_name ?></div>
                    <div id="account-avatar"><img class="lazyload" alt data-sizes="auto" data-src="<?= $user->avatar ?>" /></div>
                </div>
                <div id="account">
                    <div id="account-links">
                        <a class="account-link" href="account" aria-label="Gérer le compte">
                            <span class="account-link-icon"><?php require "include/icons/account.svg"; ?></span>
                            <span class="account-link-label">Gérer le compte</span>
                        </a>
                        <a class="account-link" href="<?= "logout?src=" . urlencode($page->id) ?>" aria-label="Se déconnecter">
                            <span class="account-link-icon"><?php require "include/icons/logout.svg"; ?></span>
                            <span class="account-link-label">Se déconnecter</span>
                        </a>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div id="login-banner">
                <a class="button" href="<?= "login?src=" . urlencode($page->id) ?>" aria-label="Se connecter">
                    <span class="button-label">Se connecter</span>
                </a>
            </div>
        <?php } ?>
    </div>
</header>