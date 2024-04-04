<?php

require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Model.php");

class Promotions
{
    private Model $Model;

    public function __construct(Model $model)
    {
        $this->Model = $model;
    }
    public function getPromotionsOptions()
    {
        $promotions = $this->Model->select("promotions", ["*"], "", false);

        foreach ($promotions as $promotion) {
            $promotionNom = htmlspecialchars($promotion->promotion_name, ENT_QUOTES, 'UTF-8');
            echo "<option value='{$promotionNom}'>{$promotionNom}</option>";
        }

        return $promotions;
    }

    public function getPromotionsList()
    {
        $promotions = $this->Model->select("promotions", ["*"], "", false);

        foreach ($promotions as $promotion) {
            $promotionNom = htmlspecialchars($promotion->promotion_name, ENT_QUOTES, 'UTF-8');
            echo "<li><input type='checkbox' name='promotions[]' id='promotion-{$promotion->promotion_id}' value='{$promotion->promotion_id}'>
            <label for='promotion-{$promotion->promotion_id}'>
            $promotionNom
            </label></li>";
        }

        return $promotions;
    }

    public function getPromotions()
    {
        $promotions = $this->Model->select("promotions", ["*"], "", false);

        return $promotions;
    }
}
