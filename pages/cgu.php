<?php

require_once("{$_SERVER["DOCUMENT_ROOT"]}/controller/SmartyCatalyst.php");

$model = new Model();
$smarty = new SmartyCatalyst($model);

$smarty->display("{$_SERVER["DOCUMENT_ROOT"]}/view/templates/cgu.tpl");
