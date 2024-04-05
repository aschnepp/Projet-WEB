{extends file="./layout.tpl"}
{block name=head}
    <!-- Main -->
    <meta charset="UTF-8">
    <title>Stage Catalyst</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="/assets/images/Logo.ico">

    <!-- Preload -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script rel="preload" src="/assets/scripts/menuburger.js"></script>

    <!-- Style -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Montserrat" as="style">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">

    <!-- PWA -->
    <link rel="manifest" href="../PWA/manifest.json" />
    <link rel="apple-touch-icon" href="../PWA/icons/apple-icon-180.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#4CAF50">
{/block}
{block name=body}
    {include file="./header.tpl"}
    <main>
        <div id="menu-burger-flou">
            <section id="menu-burger-main">
            {if isset($connected) && $connected}
                <section class="row-menu-burger">
                    <a class="fa fa-heart liens-header" id="wishlist" aria-hidden="true" rel="preconnect" href="/pages/wishlist.php"></a>
                    <p>Wishlist</p>
                </section>
            {if isset($type) && $type == "tutors" || $type == "admins"}
                <section class="row-menu-burger">
                    <a class="fa fa-building liens-header" id="entreprise" aria-hidden="true" rel="preconnect" href="/pages/gestion-entreprise.php"></a>
                    <p>Création entreprise</p>
                </section>
                <section class="row-menu-burger">
                    <a class="fa-solid fa-scroll liens-header" id="job" aria-hidden="true" rel="preconnect" href="/pages/gestion-offre.php"></a>
                    <p>Création d'offre</p>
                </section>
                <section class="row-menu-burger">
                    <a class="fa fa-users liens-header" id="student" aria-hidden="true" rel="preconnect" href="/pages/gestion-etudiant.php"></a>
                    <p>Création d'étudiant</p>
                </section>
                {if $type == "admins"}
                    <section class="row-menu-burger">
                        <a class="fa fa-briefcase liens-header" id="tutors" aria-hidden="true" rel="preconnect" href="/pages/gestion-tuteur.php"></a>
                        <p>Création de tuteur</p>
                    </section>
                {/if}
            {/if}
                <section class="row-menu-burger">
                    <a class="fa-solid fa-user liens-header" aria-hidden="true" rel="preconnect" href="/pages/profil.php"></a>
                    <p>Profil</p>
                </section>
            {else}
                <section class="row-menu-burger">
                    <a class="liens-header boutons-header" rel="preconnect" href="/pages/login.php" title="Connexion">Connexion</a>
                </section>
            {/if}
            </section>
        </div>
        {block name=main}

        {/block}
    </main>
    {include file="./footer.tpl"}
{/block}