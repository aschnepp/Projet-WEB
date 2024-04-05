<?php

require $_SERVER['DOCUMENT_ROOT'] . "/controller/SmartyCatalyst.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/model/Model.php";

$model = new Model();
$controller = new SmartyCatalyst($model);

$id = rand(1, $controller->countOffer());
$offer = $controller->getOffer($id);

while ($offer->closed == 1) {
  $id = rand(1, $controller->countOffer());
  $offer = $controller->getOffer($id);
}

$start_date = $offer->start_date;
$date = strtotime($start_date);
$date = strtotime("+{$offer->duration} Week", $date);
$date = date("Y-m-d", $date);

$offer->remuneration = round((float) $offer->remuneration, 2);
$controller->assign("offre", $offer);
$controller->assign("total_wishlist", $controller->countOfferWishlist($id));
$controller->assign("total_postulation", $controller->countOfferCandidates($id));
$controller->assign("skillsList", $controller->getOfferSkills($id));
$controller->assign("promotions", $controller->getOfferPromotions($id));
$controller->assign("firm", $controller->getFirmInfo($id));
$controller->assign("address", implode(", ", $controller->getAddresse($offer->address_id, true, [PDO::FETCH_NUM])));
$controller->assign("end_date",  $date);

$controller->display($_SERVER['DOCUMENT_ROOT'] . "/view/templates/accueil.tpl");
