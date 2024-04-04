<?php

require $_SERVER['DOCUMENT_ROOT'] . "/controller/SmartyCatalyst.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/model/Model.php";
require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Pagination.php");

// Temporaire
$entrepriseID = 13; // ID de l'entreprise
$nentreprise = 0; // Index de l'entreprise si une entreprise a plusieurs adresses

$model = new Model();
$controller = new SmartyCatalyst($model);
$Pagination = new Pagination($model);

// Récupération des données
$entreprise = $controller->reviewEntreprise($entrepriseID);
$note = $entreprise[0]->moyenne_notes;

// Transfert de données vers le JS
echo "<script>var note = '$note';</script>";

$pages = $Pagination->getLinks();
$controller->assign("entreprise", $entreprise);
$controller->assign("nentreprise", $nentreprise);
$controller->assign("pagination", $pages);
$controller->display($_SERVER['DOCUMENT_ROOT'] . "/view/templates/presentation-entreprise.tpl");
