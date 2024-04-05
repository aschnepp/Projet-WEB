<?php

require_once("{$_SERVER["DOCUMENT_ROOT"]}/model/Model.php");

class User
{
    private Model $Model;

    public function __construct(Model $model)
    {
        $this->Model = $model;
    }
    public function insertUser(array $data, string $userType)
    {
        try {
            if ($userType != "students" && $userType != "tutors") {
                throw new Exception("Type d'utilisateur pas valide.");
            }

            $condition = "email = '{$data['email']}'";
            $email = $this->selectFromUser(['*'], $condition, true);
            if ($email) {
                throw new Exception("Utilisateur déjà présent");
            }

            $condition = "street_name = '{$data['rue']}' AND street_number = '{$data['numero']}'";
            $adresse = $this->Model->select('address', ['*'], $condition, true);


            $addressData = [
                'street_name' => $data['rue'],
                'street_number' => $data['numero']
            ];
            $this->Model->insert('address', $addressData);
            $addressId = $this->Model->pdo->lastInsertId();


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


            $password = bin2hex(random_bytes(10));
            echo $password;

            $passwordHashed = password_hash($password, CRYPT_BLOWFISH);
            $userData = [
                'password' => $passwordHashed,
                'name' => $data['nom'],
                'surname' => $data['prenom'],
                'email' => $data['email'],
                'phone_number' => $data['telephone'],
                'birthdate' => $data['dateNaissance'],
                'address_id' => $addressId,
                'first_connection' => 0
            ];

            $this->Model->insert('users', $userData, true);

            $userId = $this->Model->pdo->lastInsertId();
            $campusId = $this->Model->select('campus', ['*'], "campus_name = '{$data['campus']}'");


            if ($userType == 'students') {
                $promotionId = $this->Model->select('promotions', ['*'], "promotion_name = '{$data['promotion']}'");
                $studentData = [
                    'user_id' => $userId,
                    'campus_id' => $campusId->campus_id,
                    'promotion_id' => $promotionId->promotion_id
                ];
                $this->Model->insert('students', $studentData);
                http_response_code(200);
            } else {
                $tutorData = [
                    'user_id' => $userId,
                    'campus_id' => $campusId->campus_id
                ];
                $this->Model->insert('tutors', $tutorData);
                foreach ($data['promotions'] as $promotionId) {
                    $managesData = [
                        'user_id' => $userId,
                        'promotion_id' => $promotionId
                    ];
                    $this->Model->insert('Manages', $managesData);
                }
                http_response_code(200);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            http_response_code(400);
            exit('Erreur: ' . $e->getMessage());
        }
    }

    public function deleteUser(int $id)
    {
        try {
            $userType = $this->userTypeGet($id);
            $adresse = ($this->selectFromUser(['*'], "user_id = {$id}", true))->address_id;

            switch ($userType->typeUtilisateur) {
                case 'students':
                    $this->Model->delete("Wishlists", "user_id", $id);
                    $this->Model->delete("Candidates", "user_id", $id);
                    $this->Model->delete("students", "user_id", $id);
                    break;
                case 'tutors':
                    $this->Model->delete('Manages', 'user_id', $id);
                    $this->Model->delete('tutors', 'user_id', $id);
                    break;
            }
            $this->Model->delete('users', 'user_id', $id);
            $this->Model->delete("Reviews", "user_id", $id);
            $nbAdresses = $this->Model->select("users", ['*'], "address_id = {$adresse}", false);
            if (count($nbAdresses) == 1) {
                $this->Model->delete('Contains', 'address_id', $adresse);
                $this->Model->delete('address', 'address_id', $adresse);
            }

            http_response_code(200);
        } catch (Exception $e) {
            error_log($e->getMessage());
            http_response_code(400);
            exit('Erreur: ' . $e->getMessage());
        }
    }

    public function userTypeGet(int $id)
    {
        try {
            $sqlString =
                "SELECT
                CASE
                    WHEN admins.user_id IS NOT NULL THEN 'admins'
                    WHEN tutors.user_id IS NOT NULL THEN 'tutors'
                    WHEN students.user_id IS NOT NULL THEN 'students'
                    ELSE 'Utilisateur'
                END AS typeUtilisateur
            FROM users
            LEFT JOIN tutors ON users.user_id = tutors.user_id
            LEFT JOIN admins ON users.user_id = admins.user_id
            LEFT JOIN students ON users.user_id = students.user_id
            WHERE users.user_id = :userId;";

            $query = $this->Model->pdo->prepare($sqlString);
            $query->bindParam(':userId', $id);
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            error_log($e->getMessage());
            exit('Erreur: ' . $e->getMessage());
        }
    }


    public function modifyUser(array $data, int $id)
    {
        try {
            $condition = "user_id = '{$id}'";
            $user = $this->selectFromUser(['*'], $condition, true);

            if (!$user) {
                throw new Exception("Utilisateur non existant");
            }

            $adresseId = $user->address_id;

            $addressData = [
                'street_name' => $data['rue'],
                'street_number' => $data['numero']
            ];

            $this->Model->update('address', $addressData, 'address_id', $adresseId);


            $condition = "city_name = '{$data['ville']}' AND postal_code = '{$data['codePostal']}'";
            $ville = $this->Model->select('cities', ['*'], $condition);

            if ($ville) {
                $cityId = $ville->city_id;
            } else {
                $condition = "region_name = '" . $data['region'] . "'";
                $regionId = $this->Model->select('regions', ['*'], $condition);
                $villeData = [
                    'city_name' => $data['ville'],
                    'postal_code' => $data['codePostal'],
                    'region_id' => $regionId->region_id
                ];

                $this->Model->insert('cities', $villeData);
                $cityId = $this->Model->pdo->lastInsertId();
            }

            $containsData = [
                'address_id' => $adresseId,
                'city_id' => $cityId
            ];

            $this->Model->update('Contains', $containsData, 'address_id', $adresseId);

            $userData = [
                'name' => $data['nom'],
                'surname' => $data['prenom'],
                'email' => $data['email'],
                'phone_number' => $data['telephone'],
                'birthdate' => $data['dateNaissance'],
                'address_id' => $adresseId
            ];

            $this->Model->update('users', $userData, 'user_id', $id);

            $userType = $this->userTypeGet($id);
            $campusId = $this->Model->select('campus', ['*'], "campus_name = '{$data['campus']}'");

            if ($userType->typeUtilisateur == 'students') {
                $promotionId = $this->Model->select('promotions', ['*'], "promotion_name = '{$data['promotion']}'");
                $studentData = [
                    'campus_id' => $campusId->campus_id,
                    'promotion_id' => $promotionId->promotion_id
                ];
                $this->Model->update('students', $studentData, 'user_id', $id);
                http_response_code(200);
            } else {
                $tutorData = [
                    'campus_id' => $campusId->campus_id
                ];
                $this->Model->update('tutors', $tutorData, 'user_id', $id);

                $currentPromotions = $this->Model->select('Manages', ['promotion_id'], "user_id = {$id}", false);

                $currentPromotionIds = [];

                foreach ($currentPromotions as $currentPromotion) {
                    $currentPromotionIds[] = $currentPromotion->promotion_id;
                }

                foreach ($data['promotions'] as $promotionId) {
                    if (in_array($promotionId, $currentPromotionIds)) {
                        continue;
                    }

                    $managesData = [
                        'user_id' => $id,
                        'promotion_id' => $promotionId
                    ];
                    $this->Model->insert('Manages', $managesData);
                }

                foreach ($currentPromotions as $currentPromotion) {
                    if (!in_array($currentPromotion->promotion_id, $data['promotions'])) {
                        $this->Model->delete('Manages', 'user_id', $id, 'promotion_id', $currentPromotion->promotion_id);
                    }
                }
                http_response_code(200);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            http_response_code(400);
            exit('Erreur: ' . $e->getMessage());
        }
    }

    public function selectFromUser(array $columns, string $condition = "", bool $unique = true)
    {
        try {
            $decryptedColumns = [
                "users.user_id",
                "CONVERT(aes_decrypt(users.password, '{$this->Model->key}') USING utf8) AS password",
                "CONVERT(aes_decrypt(users.email, '{$this->Model->key}') USING utf8) AS email",
                "CONVERT(aes_decrypt(users.surname, '{$this->Model->key}') USING utf8) AS surname",
                "CONVERT(aes_decrypt(users.name, '{$this->Model->key}') USING utf8) AS name",
                "CONVERT(aes_decrypt(users.phone_number, '{$this->Model->key}') USING utf8) AS phone_number",
                "CONVERT(aes_decrypt(users.birthdate, '{$this->Model->key}') USING utf8) AS birthdate",
                "users.address_id",
                "users.first_connection"
            ];

            $decryptedColumns = implode(",", $decryptedColumns);
            $columns = implode(",", $columns);
            $sqlString = "SELECT {$columns} FROM (SELECT {$decryptedColumns} FROM users) AS resultat";

            if (!empty($condition)) {
                $sqlString .= " WHERE resultat.{$condition};";
            } else {
                $sqlString .= ";";
            }

            $query = $this->Model->pdo->prepare($sqlString);
            $query->execute();
            if ($unique) {
                return $query->fetch(PDO::FETCH_OBJ);
            } else {
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            exit('Erreur: ' . $e->getMessage());
        }
    }
}
