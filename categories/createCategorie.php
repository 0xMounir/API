<?php

    // Permet d'autoriser certains sites à utiliser l'api
    // * Permet d'autoriser tous le monde à utiliser l'api
    header("Acces-Control-Allow-Origin: *");
    // Définir le contenu de la réponse, JSON
    header("Content-Type: application/json; charset=utf-8");
    // Les methodes acceptés pour la requête
    header("Acces-Control-Allow-Methods: POST");
    // La durée de vie de la requête
    header("Acces-Control-Max-Age: 3600");
    // Quels sont les headers qu'on autorise
    header("Acces-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        // On vérifie la méthode
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // On inclut les fichiers de configuration et d'accès aux données
        include_once '../config/Database.php';
        include_once '../models/Categories.php';

        // On instancie la base de données
        $database = new Database();
        $db = $database->getConnection();

        // On instancie les catégories
        $categorie = new Categories($db);

        // On récupère les informations envoyées
        $donnes = json_decode(file_get_contents("php://input"));
        
        // On reçoit les données et on vérifie s'ils sont pas vides
        if(!empty($donnes->nom)){
        
        $categorie->nom = $donnes->nom;

        if($categorie->createCategorie()){
            // La création a fonctionné
            // On envoie un code 201
            http_response_code(201);
            echo json_encode(["message" => "L'ajout de la catégorie a été effectué."]);
        } else {
            // La création n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(["message" => "L'ajout de la catégorie n'a pas été effectué."]);
        }
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Une colonne ou une valeur n'a pas été saisie."]);
    }

        } else {
            // On gère l'erreur
            http_response_code(405);
            echo json_encode(["message" => "La méthode n'est pas autorisée."]);
        }