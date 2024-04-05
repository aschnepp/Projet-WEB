<?php

include("{$_SERVER["DOCUMENT_ROOT"]}/controller/SmartyCatalyst.php");

$model = new Model();
$smarty = new SmartyCatalyst($model);

$cookie = new Cookie();

// Récupération des données
$cookie = $cookie->decodeCookieData();
if ($cookie == false) {
    header('Location: ' . "/pages/401.php");
    exit;
} else {
    $ID = $cookie->get("ID");
    $type = $smarty->userTypeGet($ID)->typeUtilisateur;
    if ($type != "admins" || $type != "tutors") {
        header('Location: ' . "/pages/401.php");
        exit;
    }
}

# firm_id = 125 et user_id = 1 pour une entreprise avec review

$id = 2;
$user_id = $ID; //TODO avec cookies
$id = 0;
$user_id = 80;

$smarty->assign("entreprise", $smarty->getFirmInfo($id));
$smarty->assign("addresses", $smarty->getFirmAdresses($id));

$smarty->assign("listeSecteurs", $smarty->getSectors());
$smarty->assign("listeSecteursChecked", $smarty->getFirmSectors($id));

$smarty->assign("review", $smarty->getFirmReviews($id, $user_id));
$smarty->assign("regions", $smarty->getAllRegion());

$smarty->assign("user_id", $user_id);

$smarty->display("{$_SERVER["DOCUMENT_ROOT"]}/view/templates/gestion-entreprise.tpl");
