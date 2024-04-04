<?php
/* Smarty version 4.5.1, created on 2024-04-04 21:00:15
  from 'C:\Users\maxim\OneDrive\Documents\CESI\A2\4-Développement-WEB\Projet\Projet-WEB\view\templates\stats-entreprise.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.1',
  'unifunc' => 'content_660ef8bf087837_92482212',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '81d74093d374c907747fd6cb843c6e4f1fe61b3b' => 
    array (
      0 => 'C:\\Users\\maxim\\OneDrive\\Documents\\CESI\\A2\\4-Développement-WEB\\Projet\\Projet-WEB\\view\\templates\\stats-entreprise.tpl',
      1 => 1712257198,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_660ef8bf087837_92482212 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_608243801660ef8bf085925_91592577', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1362853271660ef8bf086962_94951652', 'head');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_39846387660ef8bf086f91_10690072', 'main');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "./project.tpl");
}
/* {block 'title'} */
class Block_608243801660ef8bf085925_91592577 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_608243801660ef8bf085925_91592577',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    Statistiques Entreprises
<?php
}
}
/* {/block 'title'} */
/* {block 'head'} */
class Block_1362853271660ef8bf086962_94951652 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head' => 
  array (
    0 => 'Block_1362853271660ef8bf086962_94951652',
  ),
);
public $append = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <title>Statistiques Entreprises</title>
    <meta name="description" content="Statistiques des entreprises sur Stage Catalyst" />
    <?php echo '<script'; ?>
 rel="preload" src="../assets/scripts/stats-entreprises.js"><?php echo '</script'; ?>
>
    <link rel="preconnect" href="https://maps.googleapis.com" />
    <link rel="preconnect" href="https://logo.clearbit.com" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/styles/stats-entreprise.css" />
    <?php echo '<script'; ?>
 src="https://www.gstatic.com/charts/loader.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="../assets/scripts/stats-entreprises.js"><?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'head'} */
/* {block 'main'} */
class Block_39846387660ef8bf086f91_10690072 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_39846387660ef8bf086f91_10690072',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

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
<?php
}
}
/* {/block 'main'} */
}
