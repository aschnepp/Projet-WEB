<?php
/* Smarty version 4.5.1, created on 2024-04-05 08:52:11
  from 'C:\Users\maxim\OneDrive\Documents\CESI\A2\4-Développement-WEB\Projet\Projet-WEB\view\templates\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.1',
  'unifunc' => 'content_660f9f9b3eb193_01915881',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cb31ee6ee427b40f3b21ea41ba56311bafd831c3' => 
    array (
      0 => 'C:\\Users\\maxim\\OneDrive\\Documents\\CESI\\A2\\4-Développement-WEB\\Projet\\Projet-WEB\\view\\templates\\header.tpl',
      1 => 1712299925,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_660f9f9b3eb193_01915881 (Smarty_Internal_Template $_smarty_tpl) {
?><header>
    <section id="header-gauche">
        <a href="/index.php" id="image-accueil"><img src="/assets/images/Logo.webp" alt="logo" id="logo" /></a>
        <p id="header-p">Stage Catalyst</p>
    </section>

    <section id="header-milieu">
        <?php if ((isset($_smarty_tpl->tpl_vars['connected']->value)) && $_smarty_tpl->tpl_vars['connected']->value) {?>
            <input type="text" name="recherche" id="recherche" placeholder="Rechercher">
            <a class="fa fa-search liens-header" id="loupe" aria-hidden="true" href="../pages/search.php?page=1&region-offre-recherche=&date-stage-recherche=&duree-stage-recherche=8&base-remuneration-recherche=4.35&nombre-postulants-recherche=0&places-disponibles-recherche=1&type=Rechercher+Offre"></a>
        <?php } else { ?>
        <?php }?>
    </section>

    <section id="header-droite">
        <!-- Menu Burger -->
        <div id="menu-burger-header">
            <div class="barre-haut"></div>
            <div class="barre-milieu"></div>
            <div class="barre-bas"></div>
        </div>

        <!-- Contenu du header-droite -->
        <?php if ((isset($_smarty_tpl->tpl_vars['connected']->value)) && $_smarty_tpl->tpl_vars['connected']->value) {?>
            <a class="fa fa-heart liens-header" id="wishlist" aria-hidden="true" rel="preconnect" href="/pages/wishlist.php"></a>
            <?php if ((isset($_smarty_tpl->tpl_vars['type']->value)) && $_smarty_tpl->tpl_vars['type']->value == "tutors" || $_smarty_tpl->tpl_vars['type']->value == "admins") {?>
                <a class="fa fa-building liens-header" id="entreprise" aria-hidden="true" rel="preconnect" href="/pages/gestion-entreprise.php"></a>
                <a class="fa-solid fa-scroll liens-header" id="job" aria-hidden="true" rel="preconnect" href="/pages/gestion-offre.php"></a>
                <a class="fa fa-users liens-header" id="job" aria-hidden="true" rel="preconnect" href="/pages/gestion-etudiant.php"></a>
                <?php if ($_smarty_tpl->tpl_vars['type']->value == "admins") {?>
                    <a class="fa fa-briefcase liens-header" id="job" aria-hidden="true" rel="preconnect" href="/pages/gestion-tuteur.php"></a>
                <?php }?>
            <?php }?>
            <a class="fa-solid fa-user liens-header" aria-hidden="true" rel="preconnect" href="/pages/profil.php"></a>
        <?php } else { ?>
            <a class="liens-header boutons-header" rel="preconnect" href="/pages/login.php" title="Connexion">Connexion</a>
        <?php }?>

    </section>
</header><?php }
}
