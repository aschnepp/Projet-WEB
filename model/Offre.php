<?php

require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Model.php");

class Offre
{
    private Model $Model;

    public function __construct(Model $model)
    {
        $this->Model = $model;
    }

    public function insertOffer(array $data)
    {
        try {
            $condition = "firm_name = '{$data['entreprise']}'";
            $entreprise = $this->Model->select('firms', ['*'], $condition, true);

            if (!$entreprise) {
                http_response_code(400);
                throw new Exception("Entreprise n'existe pas");
            }

            $entrepriseId = $entreprise->firm_id;

            $condition = "street_name = '{$data['rue']}' AND street_number = '{$data['numero']}'";
            $adresse = $this->Model->select('address', ['*'], $condition, true);

            if ($adresse) {
                $addressId = $adresse->address_id;
            } else {
                $addressData = [
                    'street_name' => $data['rue'],
                    'street_number' => $data['numero']
                ];
                $this->Model->insert('address', $addressData);
                $addressId = $this->Model->pdo->lastInsertId();
            }

            $condition = "city_name = '{$data['ville']}' AND postal_code = '{$data['codePostal']}'";
            $ville = $this->Model->select('cities', ['*'], $condition, true);

            if ($ville) {
                $cityId = $ville->city_id;
                $regionId = $ville->region_id;
            } else {
                $condition = "region_name = '" . $data['region'] . "'";
                $regionId = $this->Model->select('regions', ['*'], $condition, true);
                $villeData = [
                    'city_name' => $data['ville'],
                    'postal_code' => $data['codePostal'],
                    'region_id' => $regionId->region_id
                ];

                $this->Model->insert('cities', $villeData);
                $cityId = $this->Model->pdo->lastInsertId();
            }

            $condition = "address_id = {$addressId}";
            $contains = $this->Model->select('Contains', ['*'], $condition, true);

            if (!$contains) {
                $containsData = [
                    'address_id' => $addressId,
                    'city_id' => $cityId
                ];
                $this->Model->insert('Contains', $containsData);
            }


            $offerData = [
                'description_offer' => $data['description'],
                'title' => $data['nom'],
                'duration' => $data['duree'],
                'remuneration' => $data['remuneration'],
                'start_date' => $data['date-debut'],
                'available_places' => $data['nombrePlaces'],
                'closed' => 0,
                'address_id' => $addressId,
                'firm_id' => $entrepriseId
            ];
            $this->Model->insert('offers', $offerData);
            $offerId = $this->Model->pdo->lastInsertId();

            foreach ($data['promotions'] as $promotion) {
                $concernsData = [
                    'offer_id' => $offerId,
                    'promotion_id' => $promotion
                ];
                $this->Model->insert('Concerns', $concernsData);
            }

            foreach ($data['competences'] as $competence) {
                $looksForData = [
                    'offer_id' => $offerId,
                    'skill_id' => $competence
                ];
                $this->Model->insert('Looks_for', $looksForData);
            }
            http_response_code(200);
        } catch (Exception $e) {
            error_log($e->getMessage());
            http_response_code(400);
            exit('Erreur: ' . $e->getMessage());
        }
    }

    public function deleteOffer(int $id)
    {
        try {
            $condition = "offer_id = {$id}";
            $offer = $this->Model->select('offers', ['*'], $condition);
            if ($offer) {
                $dataOffer = [
                    'closed' => 1
                ];
                $this->Model->update('offers', $dataOffer, 'offer_id', $id);
                http_response_code(200);
            } else {
                http_response_code(400);
                throw new Exception("Offre n'existe pas");
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            http_response_code(400);
            exit('Erreur: ' . $e->getMessage());
        }
    }

    public function updateOffer(array $data, int $id)
    {
        try {
            $condition = "offer_id = '{$id}'";
            $offre = $this->Model->select('offers', ['*'], $condition, true);

            $addressId = $offre->address_id;

            $addressData = [
                'street_name' => $data['rue'],
                'street_number' => $data['numero']
            ];

            $this->Model->update('address', $addressData, 'address_id', $addressId);

            $condition = "city_name = '{$data['ville']}' AND postal_code = '{$data['codePostal']}'";
            $ville = $this->Model->select('cities', ['*'], $condition, true);

            if ($ville) {
                $cityId = $ville->city_id;
                $regionId = $ville->region_id;
            } else {
                $condition = "region_name = '{$data['region']}'";
                $regionId = $this->Model->select('regions', ['*'], $condition, true);
                $villeData = [
                    'city_name' => $data['ville'],
                    'postal_code' => $data['codePostal'],
                    'region_id' => $regionId->region_id
                ];

                $this->Model->insert('cities', $villeData);
                $cityId = $this->Model->pdo->lastInsertId();
            }

            $containsData = [
                'address_id' => $addressId,
                'city_id' => $cityId
            ];

            $this->Model->update('Contains', $containsData, 'address_id', $addressId);

            $entreprise = $this->Model->select('firms', ['*'], "firm_name = '{$data['entreprise']}'");

            $offerData = [
                'description_offer' => $data['description'],
                'title' => $data['nom'],
                'duration' => $data['duree'],
                'remuneration' => $data['remuneration'],
                'start_date' => $data['date-debut'],
                'available_places' => $data['nombrePlaces'],
                'closed' => 0,
                'address_id' => $addressId,
                'firm_id' => $entreprise->firm_id
            ];

            $this->Model->update('offers', $offerData, 'offer_id', $id);

            $currentPromotions = $this->Model->select('Concerns', ['promotion_id'], "offer_id = {$id}", false);

            $currentPromotionIds = [];

            foreach ($currentPromotions as $currentPromotion) {
                $currentPromotionIds[] = $currentPromotion->promotion_id;
            }

            foreach ($data['promotions'] as $promotionId) {
                $promotion = $this->Model->select('Concerns', ['*'], "offer_id = {$id} AND promotion_id = {$promotionId}");
                if ($promotion) {

                    $existingPromotionId = $promotion->promotion_id;
                    if ($existingPromotionId != $promotionId) {
                        $concernsData = [
                            'promotion_id' => $promotionId
                        ];
                        $this->Model->update('Concerns', $concernsData, 'offer_id', $id);
                    }
                } else {

                    $concernsData = [
                        'offer_id' => $id,
                        'promotion_id' => $promotionId
                    ];
                    $this->Model->insert('Concerns', $concernsData);
                }
            }

            foreach ($currentPromotions as $currentPromotion) {
                if (!in_array($currentPromotion->promotion_id, $data['promotions'])) {
                    $this->Model->delete('Concerns', 'offer_id', $id, 'promotion_id', $currentPromotion->promotion_id);
                }
            }

            http_response_code(200);
        } catch (Exception $e) {
            error_log($e->getMessage());
            http_response_code(400);
            exit('Erreur: ' . $e->getMessage());
        }
    }
}
