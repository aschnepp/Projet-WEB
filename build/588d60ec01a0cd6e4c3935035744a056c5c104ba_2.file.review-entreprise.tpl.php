<?php
/* Smarty version 4.5.1, created on 2024-04-05 10:40:35
  from 'C:\Users\maxim\OneDrive\Documents\CESI\A2\4-Développement-WEB\Projet\Projet-WEB\view\templates\review-entreprise.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.1',
  'unifunc' => 'content_660fb903778289_81389305',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '588d60ec01a0cd6e4c3935035744a056c5c104ba' => 
    array (
      0 => 'C:\\Users\\maxim\\OneDrive\\Documents\\CESI\\A2\\4-Développement-WEB\\Projet\\Projet-WEB\\view\\templates\\review-entreprise.tpl',
      1 => 1712302866,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_660fb903778289_81389305 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_996008634660fb903770db5_99479935', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1438248112660fb903771b55_99526492', 'head');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2129996483660fb903772160_35585051', 'main');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "./project.tpl");
}
/* {block 'title'} */
class Block_996008634660fb903770db5_99479935 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_996008634660fb903770db5_99479935',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    Notation Entreprise
<?php
}
}
/* {/block 'title'} */
/* {block 'head'} */
class Block_1438248112660fb903771b55_99526492 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head' => 
  array (
    0 => 'Block_1438248112660fb903771b55_99526492',
  ),
);
public $append = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <meta name="description" content="Cette page vous permet de noter et commenter une entreprise dans laquelle vous avez effectué un stage." />
    <?php echo '<script'; ?>
 rel="preload" src="/assets/scripts/review-entreprise.js"><?php echo '</script'; ?>
>
    <link rel="stylesheet" href="/assets/styles/review-entreprise.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
<?php
}
}
/* {/block 'head'} */
/* {block 'main'} */
class Block_2129996483660fb903772160_35585051 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main' => 
  array (
    0 => 'Block_2129996483660fb903772160_35585051',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <form id="myForm" method="post" action="review-entreprise.php">
        <fieldset>
            <legend>Entreprise</legend>
            <div id="entreprise-review">
                <div id="logo-container"></div>
                <div class="contentEntreprise">
                    <section class="headerEntreprise">
                        <h2><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['entreprise']->value[$_smarty_tpl->tpl_vars['nentreprise']->value]->firm_name), ENT_QUOTES, 'UTF-8');?>
</h2>
                        <section id="gradeWrapper">
                            <div class="rate2">
                            </div>
                        </section>
                    </section>
                    <div class="bodyEntreprise">
                        <section class="items">
                            <img width="30" height="30" src="https://img.icons8.com/ios/45/domain.png" alt="domain" />
                            <a href="<?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['entreprise']->value[$_smarty_tpl->tpl_vars['nentreprise']->value]->website), ENT_QUOTES, 'UTF-8');?>
" target="_blank" id="website">Site Web</a>
                        </section>
                        <section class="items">
                            <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/45/map-marker.png" alt="map-marker" />
                            <p><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['entreprise']->value[$_smarty_tpl->tpl_vars['nentreprise']->value]->street_number), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['entreprise']->value[$_smarty_tpl->tpl_vars['nentreprise']->value]->street_name), ENT_QUOTES, 'UTF-8');?>
, <?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['entreprise']->value[$_smarty_tpl->tpl_vars['nentreprise']->value]->postal_code), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['entreprise']->value[$_smarty_tpl->tpl_vars['nentreprise']->value]->city_name), ENT_QUOTES, 'UTF-8');?>
</p>
                        </section>
                        <section class="items">
                            <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/45/client-company.png" alt="client-company" />
                            <p><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['entreprise']->value[$_smarty_tpl->tpl_vars['nentreprise']->value]->activity_sector_name), ENT_QUOTES, 'UTF-8');?>
</p>
                        </section>
                        <section class="items">
                            <img width="30" height="30" src="https://img.icons8.com/ios-filled/45/groups.png" alt="groups" />
                            <p><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['entreprise']->value[$_smarty_tpl->tpl_vars['nentreprise']->value]->total_postulations), ENT_QUOTES, 'UTF-8');?>
 personne(s)</p>
                        </section>
                    </div>
                </div>
                <div class="description">
                    <fieldset>
                        <legend>Description</legend>
                        <p><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['entreprise']->value[$_smarty_tpl->tpl_vars['nentreprise']->value]->description_firm), ENT_QUOTES, 'UTF-8');?>
</p>
                    </fieldset>
                </div>
            </div>

            <label for="star5" class="labels">Note</label>
            <div id="rate-wrapper">
                <div class="rate">
                    <input type="radio" id="star5" name="rating" value="5" required />
                    <label for="star5" title="Awesome"></label>
                    <input type="radio" id="star4.5" name="rating" value="4.5"/>
                    <label for="star4.5" class="half"></label>
                    <input type="radio" id="star4" name="rating" value="4" />
                    <label for="star4"></label>
                    <input type="radio" id="star3.5" name="rating" value="3.5" />
                    <label for="star3.5" class="half"></label>
                    <input type="radio" id="star3" name="rating" value="3" />
                    <label for="star3"></label>
                    <input type="radio" id="star2.5" name="rating" value="2.5" />
                    <label for="star2.5" class="half"></label>
                    <input type="radio" id="star2" name="rating" value="2" />
                    <label for="star2"></label>
                    <input type="radio" id="star1.5" name="rating" value="1.5" />
                    <label for="star1.5" class="half"></label>
                    <input type="radio" id="star1" name="rating" value="1" />
                    <label for="star1"></label>
                    <input type="radio" id="star0.5" name="rating" value="0.5" />
                    <label for="star0.5" class="half"></label>
                </div>
            </div>
            <label for="motiv" class="labels">Commentaire</label>
            <textarea id="motiv" name="motiv" required placeholder="Commentaire"><?php echo htmlspecialchars((string) ($_smarty_tpl->tpl_vars['comment']->value), ENT_QUOTES, 'UTF-8');?>
</textarea>
            <div id="loginbtns">
                <input type="submit" value="Envoyer" />
                <input type="reset" value="Réinitialiser" />
                <input type="button" onclick="javascript:window.history.back();" value="Annuler" />
            </div>
        </fieldset>
    </form>
<?php
}
}
/* {/block 'main'} */
}
