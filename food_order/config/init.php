<?php
require_once 'config.php';
require_once 'Database.php';

// Obtenir l'objet de connexion PDO
$database = new Database();
$db = $database->getConnection();