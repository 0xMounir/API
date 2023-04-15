<?php

class Animes{
    // Connexion
    private $connexion;
    private $table = "animes";

    // Object properties
    public $id;
    public $nom;
    public $synopsis;
    public $season;
    public $episodes;
    public $image;
    public $studio;
    public $start_date;
    public $categories_id;
    public $categories_nom;

    /**
     * Constructor
     * 
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }

    /**
     * Afficher les animes
     *
     * @return void
     */

    public function readAnime(){
        $sql = "SELECT c.nom as categories_nom, a.id, a.nom, a.synopsis, a.season, a.episodes, a.image, a.studio, a.start_date FROM " . $this->table . " a LEFT JOIN categories c ON a.categories_id = c.id ORDER BY a.start_date DESC";

        $query = $this->connexion->prepare($sql);

        $query->execute();
        
        return $query;
    }

    /**
     * Créer un anime
     *
     * @return void
     */

    public function createAnime(){

        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql = "INSERT INTO " . $this->table . " SET nom=:nom, synopsis=:synopsis, season=:season, episodes=:episodes, image=:image, studio=:studio, start_date=:start_date, categories_id=:categories_id";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->synopsis=htmlspecialchars(strip_tags($this->synopsis));
        $this->season=htmlspecialchars(strip_tags($this->season));
        $this->episodes=htmlspecialchars(strip_tags($this->episodes));
        $this->image=htmlspecialchars(strip_tags($this->image));
        $this->studio=htmlspecialchars(strip_tags($this->studio));
        $this->start_date=htmlspecialchars(strip_tags($this->start_date));
        $this->categories_id=htmlspecialchars(strip_tags($this->categories_id));

        // Ajout des données protégées
        $query->bindParam(":nom", $this->nom);
        $query->bindParam(":synopsis", $this->synopsis);
        $query->bindParam(":season", $this->season);
        $query->bindParam(":episodes", $this->episodes);
        $query->bindParam(":image", $this->image);
        $query->bindParam(":studio", $this->studio);
        $query->bindParam(":start_date", $this->start_date);
        $query->bindParam(":categories_id", $this->categories_id);

        // Exécution de la requête
        if($query->execute()){
            return true;
        }
        return false;
    }
}
