<?php
require_once("{$_SERVER["DOCUMENT_ROOT"]}/controller/Cookie.php");
require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Model.php");

echo "Wishlist";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cookie = new Cookie();
    $model = new Model();

    $id = $_POST['id'];
    $userId = $cookie->get('ID');

    $model->callProcedure("wishlister", [$id, $userId]);
}

http_response_code(400);
