<?php

require_once("{$_SERVER["DOCUMENT_ROOT"]}/controller/SmartyCatalyst.php");
require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Pagination.php");

$model = new Model();
$smarty = new SmartyCatalyst($model);
$Pagination = new Pagination($model);

$skillnames = $smarty->getSkillNames();
echo "<script> var skillnames = " . json_encode($skillnames) . ";</script>";

$promotions = $smarty->getPromotionsNames();
echo "<script> var promotions = " . json_encode($promotions) . ";</script>";

$regions = $smarty->getRegionsNames();
echo "<script> var regions = " . json_encode($regions) . ";</script>";

$page = $_GET['page'];
echo "<script> var page = " . $page . ";</script>";

if (isset($_GET)) {
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

            $perPage = $Pagination->getPerPage();
            $nbPages = ceil(count($offres) / $perPage);

            if ($perPage > count($offres)) {
                $perPage = count($offres);
            }

            $Offres = "";

            for ($i = ($page - 1) * $perPage; $i < ($page) * $perPage; $i++) {
                $Offres .= ' <section class="offre">
                <section class="headerOffre">
                    <h3>'  . $offres[$i]->title . ' </h3>
                    <section class="stats">
                        <section class="likes item">
                            <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/hearts.png"
                                alt="wishlists" />
                            <p>'  . $offres[$i]->total_wishlist . ' </p>
                        </section>
                        <section class="demandes item">
                            <img width="30" height="30"
                                src="https://img.icons8.com/ios-glyphs/30/secured-letter--v1.png" alt="demandes" />
                            <p>'  . $offres[$i]->total_applicants . ' </p>
                        </section>
                    </section>
                </section>
                
                <section class="infos">
                    <section class="competences item">
                        <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/learning.png"
                            alt="learning" />
                        <p>'  . $offres[$i]->skill_names . ' </p>
                    </section>
                    <section class="localisation item">
                        <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/map-marker.png"
                            alt="map-marker" />
                        <p>'  . $offres[$i]->street_number . '  '  . $offres[$i]->street_name . '  '  . $offres[$i]->postal_code . '  '  . $offres[$i]->city_name . ' </p>
                    </section>
                    <section class="entreprise-logo item">
                        <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/client-company.png"
                            alt="client-company" />
                        <p>'  . $offres[$i]->firm_name . ' </p>
                    </section>
                    <section class="promo item">
                        <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/reviewer-male.png"
                            alt="reviewer-male" />
                        <p>'  . $offres[$i]->promo_names . ' </p>
                    </section>
                    <section class="duree item">
                        <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/time--v1.png"
                            alt="time--v1" />
                        <p>'  . $offres[$i]->duration . '  Semaines</p>
                    </section>
                    <section class="date item">
                        <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/google-calendar.png"
                            alt="google-calendar" />
                        <p>'  . $offres[$i]->start_date . ' </p>
                    </section>
                    <section class="remuneration item">
                        <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/money--v1.png"
                            alt="money--v1" />
                        <p>'  . number_format($offres[$i]->remuneration, 2) . ' € / heure</p>
                    </section>
                    <section class="places item">
                        <img width="30" height="30"
                            src="https://img.icons8.com/ios-glyphs/30/conference-call--v1.png"
                            alt="conference-call--v1" />
                        <p>'  . $offres[$i]->available_places . ' </p>
                    </section>
                    <section class="description">
                        <p>'  . $offres[$i]->description_offer . ' </p>
                    </section>
                    <section class="boutons-offre">
                        <a class="postuler" href="../pages/postuler.php?id=' . $offres[$i]->offer_id . '">Postuler</a>
                        <a>Modifier offre</a>
                        <a href="javascript:wishlist(' . $offres[$i]->offer_id . ')">Ajouter à la Wishlist</a>
                    </section>
                </section>
                </section>';
            }
            $pages = $Pagination->getLinks();
            $smarty->assign("pagination", $pages);
            $smarty->assign("offres", $Offres);
        }
    }
}




$smarty->display("{$_SERVER["DOCUMENT_ROOT"]}/view/templates/search.tpl");
