<?php

require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Model.php");
require_once("{$_SERVER["DOCUMENT_ROOT"]}/controller/Cookie.php");

class Pagination
{
    private $Model = new Model();

    public function __construct(Model $model)
    {
        $this->Model = $model;
    }

    public function getLinks()
    {
        $url = $_SERVER['REQUEST_URI'];

        if (str_contains($url, "wishlist")) {
            $tableName = "Wishlists";
        } else if (str_contains($url, "presentation-entreprise")) {
            $tableName = "Reviews";
        } else {
            $tableName = "Candidates";
        }

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 1;
        // $start = ($page - 1) * $perPage;
        // $end = $start + $perPage;

        switch ($tableName) {
            case "Candidates":
            case "Wishlists":
                $Cookie = new Cookie;
                $id = $Cookie->get('ID');
                //$id = 15;
                // var_dump($id);
                $nbOffers = count($this->Model->select("{$tableName}", ['*'], "user_id = {$id}", false));
                break;
            case "Reviews":
                //$firm_id = $_POST['id'];
                $firm_id = 124;
                $nbOffers = count($this->Model->select("{$tableName}", ['*'], "firm_id = {$firm_id}", false));
                break;
        }

        $noResult = false;
        if ($nbOffers == 0) {
            $noResult = true;
        }

        $totalPages = ceil($nbOffers / $perPage);
        // var_dump($nbOffers);
        // var_dump($totalPages);

        $links = "<div id='pagination'>";

        if (($page - 1) > 1 && !$noResult) {
            $links .= '<a href="?page=1">Première</a>';
        }

        if ($page > 1 && !$noResult) {
            $links .= '<a href="?page=' . ($page - 1) . '">Précédente</a>';
        }

        if (!$noResult) {
            $links .= '<a href="?page=' . $page . '" ' . "class='active'>" . $page . '</a>';
        }

        if ($page < $totalPages  && !$noResult) {
            $links .= '<a href="?page=' . ($page + 1) . '">Suivante</a>';
        }

        if (($page + 1) < $totalPages && !$noResult) {
            $links .= '<a href="?page=' . $totalPages . '">Dernière</a>';
        }

        $links .= "</div>";

        return $links;
    }
}
