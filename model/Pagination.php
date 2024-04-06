<?php

require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Model.php");
require_once("{$_SERVER["DOCUMENT_ROOT"]}/controller/Cookie.php");

class Pagination
{
    private $Model;
    private $perPage = 2;

    public function __construct(Model $model)
    {
        $this->Model = $model;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function getLinks()
    {
        $url = $_SERVER['REQUEST_URI'];

        if (str_contains($url, "wishlist")) {
            $tableName = "Wishlists";
        } else if (str_contains($url, "presentation-entreprise")) {
            $tableName = "Reviews";
        } else if (str_contains($url, "type=Rechercher+Offre")) {
            $tableName = "OffresDeStage";
        } else {
            $tableName = "Candidates";
        }

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
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
                $firm_id = 27;
                $nbOffers = count($this->Model->select("{$tableName}", ['*'], "firm_id = {$firm_id}", false));
                break;
            case "OffresDeStage":
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
                        }
                    }
                }
                $nbOffers = count($this->Model->callProcedure("GetFilteredOffers", [$formRegion, $formCompetence, $formPromotion, $formDate, $formDuree, $formRemuneration, $formDispo]));
        }

        $noResult = false;
        if ($nbOffers == 0) {
            $noResult = true;
        }

        $totalPages = ceil($nbOffers / $this->perPage);
        // var_dump($nbOffers);
        // var_dump($totalPages);

        $links = "<div id='pagination'>";

        $url = substr($url, strpos($url, ".php") + 4);
        $link = '?page=' . $page . substr($url, strpos($url, "?") + (6 + strlen((string)$page)));

        if (($page - 1) > 1 && !$noResult) {
            $link0 = '?page=' . (1) . substr($url, strpos($url, "?") + (6 + strlen((string)$page)));
            $links .= '<a href="' . $link0 . '">Première</a>';
        }

        if ($page > 1 && !$noResult) {
            $link1 = '?page=' . ($page - 1) . substr($url, strpos($url, "?") + (6 + strlen((string)$page)));
            $links .= '<a href="' . $link1 . '">Précédente</a>';
        }

        if (!$noResult) {
            $link2 = '?page=' . ($page) . substr($url, strpos($url, "?") + (6 + strlen((string)$page)));
            $links .= '<a href="' . $link2 . '" ' . "class='active'>" . $page . " / " . $totalPages . '</a>';
        }

        if ($page < $totalPages  && !$noResult) {
            $link3 = '?page=' . ($page + 1) . substr($url, strpos($url, "?") + (6 + strlen((string)$page)));
            $links .= '<a href="' . $link3 . '">Suivante</a>';
        }

        if (($page + 1) < $totalPages && !$noResult) {
            $link4 = '?page=' . ($totalPages) . substr($url, strpos($url, "?") + (6 + strlen((string)$page)));
            $links .= '<a href="' . $link4 . '">Dernière</a>';
        }

        $links .= "</div>";

        return $links;
    }
}
