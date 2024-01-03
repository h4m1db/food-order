<?php
class Database {

    // La variable $db est privée et contient l'objet de connexion à la base de données (comme un objet PDO).
    private $db;

     // Le constructeur de la méthode intègre la connexion à la base de données
    public function __construct() {

        // DSN de connexion
        $dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST;

        // Tentative de connexion à la base de données
        try {
            $this->db = new PDO($dsn, DBUSER, DBPASS);
            // Configuration de l'UTF-8 et du mode de récupération des données
            $this->db->exec("SET NAMES utf8");
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("An error occurred: " . $e->getMessage());
        }
    }


    // La méthode getConnection est publique. Elle permet d'obtenir l'objet de connexion à la base de données.
    // Cette méthode est utilisée pour effectuer des opérations sur la base de données.
    public function getConnection() {
        return $this->db;
    }
}
?>
