<?php

    // Permet d'autoriser certains sites à utiliser l'api
    // * Permet d'autoriser tous le monde à utiliser l'api
    header("Acces-Control-Allow-Origin: *");
    // Définir le contenu de la réponse, JSON
    header("Content-Type: application/json; charset=utf-8");
    // Les methodes acceptés pour la requête
    header("Acces-Control-Allow-Methods: GET");
    // La durée de vie de la requête
    header("Acces-Control-Max-Age: 3600");
    // Quels sont les headers qu'on autorise
    header("Acces-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // On vérifie la méthode 
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        // On inclut les fichiers de configuration et d'accès aux données
        include_once '../config/Database.php';
        include_once '../models/Categories.php';

        // On instancie la base de données
        $database = new Database();
        $db = $database->getConnection();

        // On instancie les categories
        $categorie = new Categories($db);

        // On récupère les données
        $stmt = $categorie->readCategorie();

        // On vérifie si on a au moins une categorie
        if($stmt ->rowCount() > 0){
            $tableauCategories = [];
            $tableauCategories['categories'] = [];

            // On parcourt les catégories
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);

                $an = [
                    "id" => $id,
                    "nom" => htmlentities($nom),
                ];

                $tableauCategories['categories'][] = $an;
            }
            // On envoie le code réponse 200 OK
            http_response_code(200);

            // On encode en json et on envoie
            echo json_encode($tableauCategories);
        }

    } else {
        // On gère l'erreur
        http_response_code(405);
        echo json_encode(["message" => "La méthode n'est pas autorisée."]);
    }