<?php

require_once("{$_SERVER["DOCUMENT_ROOT"]}/controller/SmartyCatalyst.php");

$model = new Model();
$smarty = new SmartyCatalyst($model);

$skillnames = $smarty->getSkillNames();
echo "<script> var skillnames = " . json_encode($skillnames) . ";</script>";

$smarty->display("{$_SERVER["DOCUMENT_ROOT"]}/view/templates/search.tpl");
