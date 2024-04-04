<?php

require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Model.php");

class Entreprise
{
    private Model $Model;

    public function __construct(Model $model)
    {
        $this->Model = $model;
    }

    public function insertFirm(array $data)
    {
        try {
            $condition = "firm_name = '{$data['entreprise']}'";
            $entreprise = $this->Model->select('firms', ['*'], $condition, true);

            if ($entreprise) {
                throw new Exception("Entreprise déjà existante.");
            }


            http_response_code(200);
        } catch (Exception $e) {
            error_log($e->getMessage());
            http_response_code(400);
            exit('Erreur: ' . $e->getMessage());
        }
    }

    public function deleteFirm(int $id)
    {
        try {
            http_response_code(200);
        } catch (Exception $e) {
            error_log($e->getMessage());
            http_response_code(400);
            exit('Erreur: ' . $e->getMessage());
        }
    }

    public function updateFirm(array $data, int $id)
    {
        try {

            http_response_code(200);
        } catch (Exception $e) {
            error_log($e->getMessage());
            http_response_code(400);
            exit('Erreur: ' . $e->getMessage());
        }
    }
}
