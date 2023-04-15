<?php

class Database{
    //Connexion à la base de données
    private $host = 'localhost';
    private $db_name = 'animes';
    private $username = 'root';
    private $password = '';
    
    public $connexion;

    function __construct(){}

    // Getter pour la connexion
    public function getConnection(){

        $this->connexion = null;

        try{
            $this->connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connexion->exec("set names utf8mb4");
        }catch (PDOException $e) {
            echo "Erreur de connexion :" . $e->getMessage();
        }

        return $this->connexion;
    }
}