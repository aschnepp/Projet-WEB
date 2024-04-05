{extends file="./project.tpl"}
{block name=title}
    Statistiques Offres
{/block}
{block name=head append}
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
    <meta name="description" content="Cette page vous permet de voir les statistiques des différentes offres de la plateforme." />
    <link rel="preconnect" href="https://maps.googleapis.com" />
    <link rel="preconnect" href="https://logo.clearbit.com" />
    <script rel="preload" src="/assets/scripts/stats-offres.js"></script>
    <link rel="stylesheet" href="/assets/styles/stats-offres.css" />
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="/assets/scripts/stats-offres.js"></script>
{/block}

{block name=main}
        <div id="stats-offres">
            <div></div>
            <h2>Répartition par secteur</h2>
            <div id="piechart" class="graphiques, piecharts"></div>
            <h2>Répartition par localité</h2>
            <div id="heatmap" class="graphiques"></div>
            <h2>Top Offres</h2>
            <section id="podium">
                <div id="first" class="places">
                    <h1>🥇</h1>
                    <p id="logo1-name"></p>
                    <div id="logo1-container"></div>
                </div>
                <div id="second" class="places">
                    <h1>🥈</h1>
                    <p id="logo2-name"></p>
                    <div id="logo2-container"></div>
                </div>
                <div id="third" class="places">
                    <h1>🥉</h1>
                    <p id="logo3-name"></p>
                    <div id="logo3-container"></div>
                </div>
            </section>
            <h2>Durée de stage</h2>
            <div id="duree-offres" class="graphiques"></div>
            <h2>Promotions</h2>
            <div id="promo-piechart" class="graphiques, piecharts"></div>
            <a href="https://clearbit.com" id="attributions">Logos provided by Clearbit</a>
        </div>
{/block}