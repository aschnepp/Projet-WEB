<?php

require("{$_SERVER["DOCUMENT_ROOT"]}/model/Entreprise.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = $_SERVER['HTTP_REFERER'];
    $Model = new Model;
    $Entreprise = new Entreprise($Model);

    $user_id = (int) $_POST['user_id'];

    $adresses = [];

    foreach ($_POST['adresse-entreprise'] as $index => $adresse) {
        $rue = $_POST["adresse-entreprise"][$index];
        $numero = $_POST["street_number-entreprise"][$index];
        $codePostal = $_POST["postal_code-entreprise"][$index];
        $ville = $_POST["locality-entreprise"][$index];
        $region = $_POST["administrative_area_level_1-entreprise"][$index];

        $adresseArray = [
            'rue' => $rue,
            'numero' => $numero,
            'codePostal' => $codePostal,
            'ville' => $ville,
            'region' => $region
        ];

        $adresses[] = $adresseArray;
    }

    $data = [
        'nom' => $_POST['nom-entreprise'],

        'adresses' =>  $adresses,

        'secteurs' => $_POST['secteurs'],

        'site_web' => $_POST['site-web-entreprise'],

        'description' => $_POST['description-entreprise'],

        'note' => (($_POST['rating'])) ? (int) isset($_POST['rating']) : null,

        'commentaire' => isset($_POST['commentaire-entreprise']) ? $_POST['commentaire-entreprise'] : "",

        'inactive' => isset($_POST['inactivite-entreprise']) ? 1 : 0
    ];

    // $firm_id = 214;

    $Entreprise->insertFirm($data, $user_id);
    // $Entreprise->updateFirm($data, $firm_id, $user_id);
    // $Entreprise->deleteFirm($firm_id);
}
