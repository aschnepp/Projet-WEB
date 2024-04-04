{extends file="./project.tpl"}
{block name=title}
    Connexion
{/block}
{block name=head append}
    <meta name="description" content="Cette page vous permet de vous connecter au site">
    <link rel="preload" href="/assets/styles/login.css" as="style">
    <link rel="stylesheet" href="/assets/styles/login.css">
    <script rel="preload" src="/assets/scripts/cookies.js"></script>
{/block}

{block name=main}
    <form id="myForm" method="post" onsubmit="connect(event)">
      <fieldset>
        <label for="email">Identifiant</label>
        <input type="text" id="email" name="email" required autocomplete="on" placeholder="Email">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" minlength="8" required autocomplete="off" placeholder="Mot de passe (fourni 1ere fois)">
        <div id="remember">
          <input type="checkbox" id="souvenir" name="souvenir" />
          <label for="souvenir">Se souvenir de moi</label>
        </div>
        <div id="loginbtns">
          <input type="submit" value="Envoyer" />
          <input type="reset" value="Réinitialiser" />
          <input type="button" onclick="javascript:window.history.back();" value="Annuler" />
        </div>
      </fieldset>
    </form>
{/block}