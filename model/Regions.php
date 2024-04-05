<?php

require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Model.php");

class Regions
{

    private Model $Model;

    public function __construct(Model $model)
    {
        $this->Model = $model;
    }

    public function getRegions()
    {
        $regions = $this->Model->select("regions", ["*"], "", false, [PDO::FETCH_COLUMN, 1]);
        return $regions;
    }
    public function getRegionsList()
    {
        $Model = new Model;
        $regions = $Model->select("regions", ["*"], "", false);

        foreach ($regions as $region) {
            $regionNom = htmlspecialchars($region->region_name, ENT_QUOTES, 'UTF-8');
            echo "<option value='{$regionNom}'>{$regionNom}</option>";
        }

        return $regions;
    }
}
