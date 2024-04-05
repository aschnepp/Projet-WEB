<?php
/* Smarty version 4.5.1, created on 2024-04-05 10:40:36
  from 'C:\Users\maxim\OneDrive\Documents\CESI\A2\4-Développement-WEB\Projet\Projet-WEB\view\templates\stats-offres.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.1',
  'unifunc' => 'content_660fb904b659f6_46033848',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cfcf6d9f0ef9d3ca1557d2f612a71fb9a8ca667a' => 
    array (
      0 => 'C:\\Users\\maxim\\OneDrive\\Documents\\CESI\\A2\\4-Développement-WEB\\Projet\\Projet-WEB\\view\\templates\\stats-offres.tpl',
      1 => 1712302866,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_660fb904b659f6_46033848 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2003805051660fb904b646d0_97889361', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1753812416660fb904b65051_13286194', 'head');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1621645753660fb904b655a8_08788782', 'main');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "./project.tpl");
}
/* {block 'title'} */
class Block_2003805051660fb904b646d0_97889361 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_2003805051660fb904b646d0_97889361',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    Statistiques Offres
<?php
}
}
/* {/block 'title'} */
/* {block 'head'} */
class Block_1753812416660fb904b65051_13286194 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head' => 
  array (
    0 => 'Block_1753812416660fb904b65051_13286194',
  ),
);
public $append = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
    <meta name="description" content="Cette page vous permet de voir les statistiques des différentes offres de la plateforme." />
    <link rel="preconnect" href="https://maps.googleapis.com" />
    <link rel="preconnect" href="https://logo.clearbit.com" />
    <?php echo '<script'; ?>
 rel="preload" src="/assets/scripts/stats-offres.js"><?php echo '</script'; ?>
>
    <link rel="stylesheet" href="/assets/styles/stats-offres.css" />
    <?php echo '<script'; ?>
 src="https://www.gstatic.com/charts/loader.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/assets/scripts/stats-offres.js"><?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'head'} */
/* {block 'main'} */
class Block_1621645753660fb904b655a8_08788782 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_1621645753660fb904b655a8_08788782',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

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
<?php
}
}
/* {/block 'main'} */
}
