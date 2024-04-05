<?php

require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Model.php");

class Secteurs
{
    private Model $Model;

    public function __construct(Model $model)
    {
        $this->Model = $model;
    }

    public function getSecteurs()
    {
        $secteurs = $this->Model->select("activity_sectors", ["*"], "", false, [PDO::FETCH_COLUMN, 1]);

        return $secteurs;
    }

    public function getSecteursList()
    {
        $secteurs = $this->Model->select("activity_sectors", ["*"], "", false);

        foreach ($secteurs as $secteur) {
            $secteurNom = htmlspecialchars($secteur->activity_sector_name, ENT_QUOTES, 'UTF-8');
            echo "<li><input type='checkbox' name='secteurs[]' id='secteur-{$secteur->activity_sector_id}' value='{$secteur->activity_sector_name}'>
            <label for='secteur-{$secteur->activity_sector_id}'>
            $secteurNom
            </label></li>";
        }

        return $secteurs;
    }
}
