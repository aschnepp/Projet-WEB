<?php

require $_SERVER['DOCUMENT_ROOT'] . "/controller/SmartyCatalyst.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/model/Model.php";

$model = new Model();
$controller = new SmartyCatalyst($model);

// Affiche le template
$controller->display($_SERVER['DOCUMENT_ROOT'] . "/view/templates/presentation-entreprise.tpl");
