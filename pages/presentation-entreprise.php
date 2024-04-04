<?php

require $_SERVER['DOCUMENT_ROOT'] . "/controller/SmartyCatalyst.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/model/Model.php";
require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Pagination.php");

// Temporaire
$entrepriseID = 27; // ID de l'entreprise
$nentreprise = 0; // Index de l'entreprise si une entreprise a plusieurs adresses

$model = new Model();
$controller = new SmartyCatalyst($model);
$Pagination = new Pagination($model);

$Avis = "";
$scriptNotes = "";

// Récupération des données
$entreprise = $controller->reviewEntreprise($entrepriseID);
$commentaires = $controller->getCommentaires($entrepriseID);
$page = $_GET['page'];

$perPage = $Pagination->getPerPage();
$nbPages = ceil(count($commentaires) / $perPage);

if ($perPage > count($commentaires)) {
    $perPage = count($commentaires);
}

if ($entreprise[0]->moyenne_notes) {
    $note = $entreprise[0]->moyenne_notes;
} else {
    $note = 0;
}



for ($i = ($page - 1) * $perPage; $i < ($page) * $perPage; $i++) {
    $Avis .= "<section class='avis-utilisateur'><section class='gradeWrapper' id='grade-" . $i + 1 . "'><div class='rate2'></div></section><p>" . $commentaires[$i]->comment . "</p></section>";
    $scriptNotes .= "<script>displayGrade(" . $commentaires[$i]->note . ", " . $i + 1 . ");</script>";
}

// Transfert de données vers le JS
echo "<script>var note = '$note';</script>";

$pages = $Pagination->getLinks();
$controller->assign("entreprise", $entreprise);
$controller->assign("nentreprise", $nentreprise);
$controller->assign("pagination", $pages);
$controller->assign("avis", $Avis);
$controller->assign("scriptNotes", $scriptNotes);
$controller->display($_SERVER['DOCUMENT_ROOT'] . "/view/templates/presentation-entreprise.tpl");

// ID de test : 27 (Aussi dans le fichier Pagination pour les tests)
