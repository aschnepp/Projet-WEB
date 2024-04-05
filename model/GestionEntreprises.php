<?php

require("{$_SERVER["DOCUMENT_ROOT"]}/model/Entreprise.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = $_SERVER['HTTP_REFERER'];
    $Model = new Model;
    $Entreprise = new Entreprise($Model);


    $bouton = $_POST['submit'];
    var_dump($bouton);
    echo "<br>";
    echo "<br>";

    echo "test";
    $user_id = (int) $_POST['user_id'];

    var_dump($bouton);
    echo "<br>";

    var_dump($user_id);

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

        'note' => (int) ($_POST['rating']),

        'commentaire' => isset($_POST['commentaire-entreprise']) ? $_POST['commentaire-entreprise'] : "",

        'inactive' => isset($_POST['inactivite-entreprise']) ? 1 : 0
    ];

    var_dump($data);

    if ($bouton == "delete") {
        $Entreprise->deleteFirm($user_id);
    } elseif ($bouton == "update") {
        $Entreprise->updateFirm($data, $user_id);
    } else {
        $Entreprise->insertFirm($data);
    }
}