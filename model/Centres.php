<?php

require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Model.php");

class Centres
{
    private Model $Model;

    public function __construct(Model $model)
    {
        $this->Model = $model;
    }
    public function getCentresOptions()
    {
        $centres = $this->Model->select("campus", ["*"], "", false);

        foreach ($centres as $centre) {
            $centreNom = htmlspecialchars($centre->campus_name, ENT_QUOTES, 'UTF-8');
            $liste = "<option value='{$centreNom}'>{$centreNom}</option>";
            echo $liste;
        }

        return $centres;
    }

    public function getCentres()
    {
        $centres = $this->Model->select("campus", ["*"], "", false);

        return $centres;
    }
}
