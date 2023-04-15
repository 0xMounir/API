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
        include_once '../models/Animes.php';

        // On instancie la base de données
        $database = new Database();
        $db = $database->getConnection();

        // On instancie les animes
        $anime = new Animes($db);

        // On récupère les données
        $stmt = $anime->readAnime();

        // On vérifie si on a au moins 1 anime
        if($stmt ->rowCount() > 0){
            $tableauAnimes = [];
            $tableauAnimes['animes'] = [];

            // On parcourt les animes
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);

                $an = [
                    "id" => $id,
                    "nom" => $nom,
                    "synopsis" => htmlentities($synopsis),
                    "season" => $season,
                    "episodes" => $episodes,
                    "image" => htmlentities($image),
                    "studio" => $studio,
                    "start_date" => $start_date,
                    "categories_nom" => $categories_nom
                ];

                $tableauAnimes['animes'][] = $an;
            }
            // On envoie le code réponse 200 OK
            http_response_code(200);

            // On encode en json et on envoie
            echo json_encode($tableauAnimes);
        }

    } else {
        // On gère l'erreur
        http_response_code(405);
        echo json_encode(["message" => "La méthode n'est pas autorisée."]);
    }