<?php

require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Model.php");

class Entreprises
{
    private Model $Model;

    public function __construct(Model $model)
    {
        $this->Model = $model;
    }

    public function getEntreprisesOptions()
    {
        $entreprises = $this->Model->select("firms", ["*"], "", false);

        foreach ($entreprises as $entreprise) {
            $entrepriseNom = htmlspecialchars($entreprise->firm_name, ENT_QUOTES, 'UTF-8');
            echo "<option value='{$entrepriseNom}'>{$entrepriseNom}</option>";
        }

        return $entreprises;
    }

    public function getEntreprises()
    {
        $entreprises = $this->Model->select("firms", ["*"], "", false);

        return $entreprises;
    }
}
