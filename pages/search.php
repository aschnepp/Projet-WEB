<?php

require_once("{$_SERVER["DOCUMENT_ROOT"]}/controller/SmartyCatalyst.php");

$model = new Model();
$smarty = new SmartyCatalyst($model);

$skillnames = $smarty->getSkillNames();
echo "<script> var skillnames = " . json_encode($skillnames) . ";</script>";

$promotions = $smarty->getPromotionsNames();
echo "<script> var promotions = " . json_encode($promotions) . ";</script>";

$regions = $smarty->getRegionsNames();
echo "<script> var regions = " . json_encode($regions) . ";</script>";

if (isset($_GET)) {
    var_dump($_GET);
    if (isset($_GET["type"])) {
        $formType = $_GET["type"];
        if ($formType == "Rechercher Offre") {
            if (isset($_GET["region-offre-recherche"])) {
                $formRegion = $_GET["region-offre-recherche"];
                if ($formRegion == "") {
                    $formRegion = NULL;
                }
            } else {
                $formRegion = NULL;
            }
            if (isset($_GET["competences-recherche"])) {
                $formCompetence = $_GET["competences-recherche"];
            } else {
                $formCompetence = NULL;
            }
            if (isset($_GET["promotions-concernees-recherche"])) {
                $formPromotion = $_GET["promotions-concernees-recherche"];
            } else {
                $formPromotion = NULL;
            }
            if (isset($_GET["date-stage-recherche"])) {
                $formDate = $_GET["date-stage-recherche"];
                if ($formDate == "") {
                    $formDate = NULL;
                }
            } else {
                $formDate = NULL;
            }
            if (isset($_GET["duree-stage-recherche"])) {
                $formDuree = $_GET["duree-stage-recherche"];
            } else {
                $formDuree = NULL;
            }
            if (isset($_GET["base-remuneration-recherche"])) {
                $formRemuneration = $_GET["base-remuneration-recherche"];
            } else {
                $formRemuneration = NULL;
            }
            if (isset($_GET["nombre-postulants-recherche"])) {
                $formPostulants = $_GET["nombre-postulants-recherche"];
            } else {
                $formPostulants = NULL;
            }
            if (isset($_GET["places-disponibles-recherche"])) {
                $formDispo = $_GET["places-disponibles-recherche"];
            } else {
                $formDispo = NULL;
            }

            $offres = $smarty->rechercherOffres($formRegion, $formCompetence, $formPromotion, $formDate, $formDuree, $formRemuneration, $formDispo);

            echo "<pre>";
            var_dump($offres);
            echo "</pre>";
        }
    }
}

$smarty->display("{$_SERVER["DOCUMENT_ROOT"]}/view/templates/search.tpl");
