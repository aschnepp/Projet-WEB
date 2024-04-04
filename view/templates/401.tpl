{extends file="./project.tpl"}
{block name=title}
    Erreur 401
{/block}
{block name=head append}
    <meta name="description" content="Une page d'erreur 403 : accès non autorisé">
    <link rel="preload" href="/assets/styles/401.css" as="style">
    <link rel="stylesheet" href="/assets/styles/401.css">
{/block}

{block name=main}
    <section>
        <h1>ERREUR 401</h1>
        <h2>Accès non autorisé</h2>
        <h3>VEUILLEZ VOUS CONNECTER AFIN D'ACCEDER A CETTE PAGE</h3>
        <a href="javascript:window.history.back();" id="back-btn">Revenir à la page précédente</a>
    </section>
{/block}