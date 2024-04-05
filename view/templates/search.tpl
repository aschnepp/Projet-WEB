{extends file="./project.tpl"}
{block name=title}
    Recherche
{/block}
{block name=head append}
    <meta name="description" content="Page de recherche.">
    <title>Recherche</title>
    <script rel="preload" src="/assets/scripts/search.js"></script>
    <script rel="preload" src="/assets/scripts/filtre.js"></script>
    <link rel="stylesheet" href="/assets/styles/search.css" />
{/block}

{block name=main}
    <div id="filtre-cliquable">
        <button type="button" class="fa-solid fa-filter" id="icone-filtre"></button>
        <label for="icone-filtre" id="label-icone-filtre" title="Filtrer">Filtrer</label>
    </div>
    <div id="page-recherche">
        <section id="recherche-filtre-main">
            <form method="get">   
            <section id="menu-filtre">
                <section id="header-filtre">
                    <h3>Filtres</h3>
                    <div>
                        <button type="button" class="fa-solid fa-xmark" name="fermer-filtre" id="fermer-filtre"></button>
                        <label for="fermer-filtre" id="label-fermer-filtre" title="Fermer">Fermer</label>
                    </div>
                </section>
                <label for="choix-recherche" id="label-menu-filtre">Choix du filtre</label>
                <select id="choix-recherche" name="choix-recherche">
                    <option value="menu-offre" id="menu-offre">Offre</option>
                    <option value="menu-entreprise" id="menu-entreprise">Entreprise</option>
                    <option value="menu-etudiant" id="menu-etudiant">Etudiant</option>
                    <option value="menu-tuteur" id="menu-tuteur">Tuteur</option>
                </select>
            </section>
            </form>
            <form id="recherche-menu">
            </form>
        </section>
        <div id="affichage-filtre">
        {$offres nofilter}
        {$pagination nofilter}
        </div>
        <!-- TODO: METTRE BOUTON MODIFIER SUR OFFRE ET ENTREPRISES SUR TUTEURS OU ADMIN -->
    </div>
{/block}