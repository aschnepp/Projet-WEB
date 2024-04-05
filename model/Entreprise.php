<?php

require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Model.php");

class Entreprise
{
    private Model $Model;

    public function __construct(Model $model)
    {
        $this->Model = $model;
    }

    public function insertFirm(array $data, $userId)
    {
        try {
            $condition = "firm_name = '{$data['nom']}'";
            $entreprise = $this->Model->select('firms', ['*'], $condition, true);

            if ($entreprise) {
                throw new Exception("Entreprise déjà existante.");
            }

            $firmsData = [
                'firm_name' => $data['nom'],
                'description_firm' => $data['description'],
                'website' => $data['site_web'],
                'inactif' => 0
            ];

            $this->Model->insert('firms', $firmsData);
            $firmId = $this->Model->pdo->lastInsertId();

            $reviewData = [
                'user_id' => $userId,
                'firm_id' => $firmId,
                'note' => $data['note'],
                'comment' => $data['commentaire']
            ];

            $this->Model->insert('Reviews', $reviewData);

            foreach ($data['secteurs'] as $secteurNom) {
                $Is_aboutData = [
                    'firm_id' => $firmId,
                    'activity_sector_id' => ($this->Model->select('activity_sectors', ['*'], "activity_sector_name = '{$secteurNom}'", true))->activity_sector_id
                ];
                $this->Model->insert('Is_about', $Is_aboutData);
            }

            var_dump($data['adresses']);

            foreach ($data['adresses'] as $adresse) {
                $addressData = [
                    'street_name' => $adresse['rue'],
                    'street_number' => $adresse['numero'], // Utilisation de 'numero' au lieu de 'street_number'
                ];
                $this->Model->insert('address', $addressData);
                $addressId = $this->Model->pdo->lastInsertId();

                $condition = "city_name = '{$adresse['ville']}' AND postal_code = '{$adresse['codePostal']}'";
                $ville = $this->Model->select('cities', ['*'], $condition, true);

                if ($ville) {
                    $cityId = $ville->city_id;
                    $regionId = $ville->region_id;
                } else {
                    $condition = "region_name = '{$adresse['region']}'"; // Utilisation de 'region' au lieu de 'region_name'
                    $regionId = $this->Model->select('regions', ['*'], $condition, true);
                    $villeData = [
                        'city_name' => $adresse['ville'],
                        'postal_code' => $adresse['codePostal'],
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

                $Is_atData = [
                    'address_id' => $addressId,
                    'firm_id' => $firmId
                ];
                $this->Model->insert('Is_at', $Is_atData);
            }
            http_response_code(200);
        } catch (Exception $e) {
            error_log($e->getMessage());
            http_response_code(400);
            exit('Erreur: ' . $e->getMessage());
        }
    }


    public function updateFirm(array $data, int $id, int $userId)
    {
        try {
            $reviewData = [
                'user_id' => $userId,
                'firm_id' => $id,
                'note' => $data['note'],
                'comment' => $data['commentaire']
            ];

            if ($this->Model->select('Reviews', ['*'], "user_id = {$userId} AND firm_id = {$id}")) {
                $this->Model->delete('Reviews', "user_id", $userId, "firm_id", $id);
            }
            $this->Model->insert('Review', $reviewData);

            $firmsData = [
                'firm_name' => $data['nom'],
                'description_firm' => $data['description'],
                'website' => $data['site_web'],
                'inactif' => $data['inactive']
            ];

            $this->Model->update('firms', $firmsData, 'firm_id', $id);

            $currentSectors = $this->Model->select('Is_about', ['*'], "firm_id = {$id}", false);

            $currentSectorsIds = [];

            foreach ($currentSectors as $currentSector) {
                $currentSectorsIds[] = $currentSector->activity_sector_id;
            }

            foreach ($data['secteurs'] as $sector) {
                $sectorId = $sector->activity_sector_id;

                if (in_array($sectorId, $currentSectorsIds)) {
                    continue;
                }

                $isAboutData = [
                    'firm_id' => $id,
                    'activity_sector_id' => $sectorId
                ];
                $this->Model->insert('Is_about', $isAboutData);
            }

            foreach ($currentSectors as $currentSector) {
                if (!in_array($currentSector->activity_sector_id, array_column($data['secteurs'], 'activity_sector_id'))) {
                    $this->Model->delete('Is_about', 'firm_id', $id, 'activity_sector_id', $currentSector->activity_sector_id);
                }
            }

            $currentAddresses = $this->Model->select('Is_at', ['*'], "firm_id = {$id}", false);

            $currentAddressIds = [];
            foreach ($currentAddresses as $currentAddress) {
                $currentAddressIds[] = $currentAddress->address_id;
            }

            foreach ($data['adresses'] as $address) {
                $addressId = $address['address_id'];

                if (in_array($addressId, $currentAddressIds)) {
                    continue;
                }

                $isAtData = [
                    'firm_id' => $id,
                    'address_id' => $addressId
                ];
                $this->Model->insert('Is_at', $isAtData);
            }

            foreach ($currentAddresses as $currentAddress) {
                if (!in_array($currentAddress->address_id, array_column($data['adresses'], 'address_id'))) {
                    $this->Model->delete('Is_at', 'firm_id', $id, 'address_id', $currentAddress->address_id);
                }
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
            $deleteData = [
                'inactif' => 1
            ];

            $get = $this->Model->select('firms', ['*'], "firm_id = {$id}");
            if (!$get) {
                throw new Exception("Entreprise non existante.");
            }

            $this->Model->update('firms', $deleteData, 'firm_id', $id);
            http_response_code(200);
        } catch (Exception $e) {
            error_log($e->getMessage());
            http_response_code(400);
            exit('Erreur: ' . $e->getMessage());
        }
    }
}
