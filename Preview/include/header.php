<header class="header">
    <div class="logo-container">
        <a class="logo" href="home">Mediator</a>
    </div>
    <div class="nav-container">
        <nav class="nav">
            <a class="nav-el <?php if (URI == "home") echo "active"; ?>" href="home">
                <div class="nav-el-icon"><svg version="1.1" viewBox="0 0 36 36"><path d="M26.882 19.414v10.454h-5.974v-5.227h-5.974v5.227H8.961V19.414H5.227L17.921 6.72l12.694 12.694h-3.733z" class="sc-jzJRlG dPjNeY"></path></svg></div>
                <div class="nav-el-label">Accueil</div>
            </a>
            <a class="nav-el <?php if (URI == "search") echo "active"; ?>" href="search">
                <div class="nav-el-icon"><svg version="1.1" viewBox="0 0 36 36"><path d="M21.866 24.337c-3.933 2.762-9.398 2.386-12.914-1.13-3.936-3.936-3.936-10.318 0-14.255 3.937-3.936 10.32-3.936 14.256 0 3.327 3.327 3.842 8.402 1.545 12.27l4.56 4.558a2 2 0 0 1 0 2.829l-.174.173a2 2 0 0 1-2.828 0l-4.445-4.445zm-5.786-1.36a6.897 6.897 0 1 0 0-13.794 6.897 6.897 0 0 0 0 13.794z" class="sc-jzJRlG dPjNeY"></path></svg></div>
                <div class="nav-el-label">Rechercher</div>
            </a>
            <a class="nav-el <?php if (URI == "library") echo "active"; ?>" href="library">
                <div class="nav-el-icon"><svg version="1.1" viewBox="0 0 36 36"><path d="M24.71 20.07a2.97 2.97 0 1 0-4.2-4.2 2.97 2.97 0 0 0 4.2 4.2m-12.262 0a2.97 2.97 0 1 0-4.2-4.2 2.97 2.97 0 0 0 4.2 4.2m6.173-10.31a2.969 2.969 0 1 0-4.199 4.198 2.969 2.969 0 0 0 4.199-4.198m0 12.262a2.969 2.969 0 1 0-4.199 4.198 2.969 2.969 0 0 0 4.199-4.198m-1.544-4.629a.846.846 0 1 0-1.197 1.196.846.846 0 0 0 1.197-1.196m18.06-.644c-3.33 6.913-8.165 9.928-11.635 11.24-2.57.971-4.762 1.178-5.949 1.208-.348.032-.698.053-1.052.053C10.287 29.25 5.25 24.213 5.25 18S10.287 6.75 16.5 6.75c6.214 0 11.25 5.037 11.25 11.25a11.19 11.19 0 0 1-2.493 7.054c2.832-1.612 5.844-4.382 8.138-9.143a.968.968 0 0 1 1.742.838" class="sc-jzJRlG dPjNeY"></path></svg></div>
                <div class="nav-el-label">Bibliothèque</div>
            </a>
        </nav>
    </div>
    <div class="account-container">
        <div class="account">
            <div class="account-banner">
                <div class="account-banner-label"><?= $user["FirstName"] ?></div>
                <div class="account-banner-avatar"><img class="lazyload" data-sizes="auto" data-srcset="https://prod-ripcut-delivery.disney-plus.net/v1/variant/disney/325657153FFEAFC17E77029146D3560B28C41D3292EC96B3034DFEB508AB2457/scale?width=40&format=png 1x, https://prod-ripcut-delivery.disney-plus.net/v1/variant/disney/325657153FFEAFC17E77029146D3560B28C41D3292EC96B3034DFEB508AB2457/scale?width=80&format=png 2x" data-src="https://prod-ripcut-delivery.disney-plus.net/v1/variant/disney/325657153FFEAFC17E77029146D3560B28C41D3292EC96B3034DFEB508AB2457/scale?width=40&format=png" /></div>
            </div>
            <div class="account-nav">
                <a class="account-nav-el" href="account">Compte</a>
                <a class="account-nav-el" href="logout">Se déconnecter</a>
            </div>
        </div>
    </div>
</header>
