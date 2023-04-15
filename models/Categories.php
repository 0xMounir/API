<?php

class Categories{
    // Connexion
    private $connexion;
    private $table = "categories";


    // Object properties
    public $id;
    public $nom;

    /**
     * Constructor
     * 
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }

    /**
     * Afficher les catégories
     *
     * @return void
     */

    public function readCategorie(){
        $sql = "SELECT * FROM " . $this->table . " ORDER BY id DESC";

        $query = $this->connexion->prepare($sql);

        $query->execute();
        
        return $query;
    }

    /**
     * Créer une catégorie
     *
     * @return void
     */

    public function createCategorie(){

        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql = "INSERT INTO " . $this->table . " SET nom=:nom";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
        $this->nom=htmlspecialchars(strip_tags($this->nom));

        // Ajout des données protégées
        $query->bindParam(":nom", $this->nom);

        // Exécution de la requête
        if($query->execute()){
            return true;
        }
        return false;
    }
}
