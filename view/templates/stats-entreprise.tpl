{extends file="./project.tpl"}
{block name=title}
    Statistiques Entreprises
{/block}
{block name=head append}
    <title>Statistiques Entreprises</title>
    <meta name="description" content="Statistiques des entreprises sur Stage Catalyst" />
    <script rel="preload" src="../assets/scripts/stats-entreprises.js"></script>
    <link rel="preconnect" href="https://maps.googleapis.com" />
    <link rel="preconnect" href="https://logo.clearbit.com" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/styles/stats-entreprise.css" />
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="../assets/scripts/stats-entreprises.js"></script>
{/block}

{block name=main}
    <div id="stats-entreprise">
        <div></div>
        <h2>Répartition par secteur</h2>
        <div id="piechart"></div>
        <h2>Répartition par localité</h2>
        <div id="regions_div"></div>
        <h2>Top entreprises</h2>
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
        <a href="https://clearbit.com" id="attributions">Logos provided by Clearbit</a>
    </div>
{/block}