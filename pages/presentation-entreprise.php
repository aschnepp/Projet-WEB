<?php

require $_SERVER['DOCUMENT_ROOT'] . "/controller/SmartyCatalyst.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/model/Model.php";
require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Pagination.php");

$model = new Model();
$controller = new SmartyCatalyst($model);
$Pagination = new Pagination;
$pages = $Pagination->getLinks();

$controller->assign("pagination", $pages);
$controller->display($_SERVER['DOCUMENT_ROOT'] . "/view/templates/presentation-entreprise.tpl");
