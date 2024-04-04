<header>
    <section id="header-gauche">
        <a href="/index.php" id="image-accueil"><img src="/assets/images/Logo.webp" alt="logo" id="logo" /></a>
        <p id="header-p">Stage Catalyst</p>
    </section>

    <section id="header-milieu">
        {if isset($connected) && $connected}
            <input type="text" name="recherche" id="recherche" placeholder="Rechercher">
            <a class="fa fa-search" id="loupe" aria-hidden="true" href="/pages/search.php"></a>
        {else}
        {/if}
    </section>

    <section id="header-droite">
        <!-- Menu Burger -->
        <div id="menu-burger-header">
            <div class="barre-haut"></div>
            <div class="barre-milieu"></div>
            <div class="barre-bas"></div>
        </div>

        <!-- Contenu du header-droite -->
        {if isset($connected) && $connected}
            <a class="fa fa-heart liens-header" id="wishlist" aria-hidden="true" rel="preconnect" href="/pages/wishlist.php"></a>
            {if isset($type) && $type == "tutors" || $type == "admins"}
                <a class="fa fa-building liens-header" id="entreprise" aria-hidden="true" rel="preconnect" href="/pages/gestion-entreprise.php"></a>
                <a class="fa-solid fa-scroll liens-header" id="job" aria-hidden="true" rel="preconnect" href="/pages/gestion-offre.php"></a>
                <a class="fa fa-users liens-header" id="job" aria-hidden="true" rel="preconnect" href="/pages/gestion-etudiant.php"></a>
                {if $type == "admins"}
                    <a class="fa fa-briefcase liens-header" id="job" aria-hidden="true" rel="preconnect" href="/pages/gestion-tuteur.php"></a>
                {/if}
            {/if}
            <a class="fa-solid fa-user liens-header" aria-hidden="true" rel="preconnect" href="/pages/profil.php"></a>
        {else}
            <a class="liens-header boutons-header" rel="preconnect" href="/pages/login.php" title="Connexion">Connexion</a>
        {/if}

    </section>
</header>