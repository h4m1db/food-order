<?php
require('config/init.php');

class Food {

    /**
     * Retourne les catégories des plats
     * @return array
     */
    public function categoriesFood() {

        global $db;

        // Pas de SELECT * car prend de la ressource inutilement
        $requete = $db->prepare("SELECT tbl_category.id, tbl_category.title, tbl_category.image_name, tbl_category.featured, tbl_category.active FROM tbl_category WHERE active = 'yes' AND featured = 'yes' LIMIT 3");

        try {
            $requete->execute();
            return $requete->fetchAll();
        } catch (Exception $e) {
            // Log l'erreur au lieu de l'afficher
            error_log('Erreur dans categoriesFood : ' . $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }

    /**
     * Retourne les plats
     * @return array
     */
    public function getFoods() {

        global $db;

        // Pas de SELECT * car prend de la ressource inutilement
        $requete = $db->prepare("SELECT tbl_food.id, tbl_food.title, tbl_food.description, tbl_food.price, tbl_food.image_name, tbl_food.category_id, tbl_food.featured, tbl_food.active FROM  tbl_food WHERE active= 'yes' AND featured='yes' LIMIT 6");

        try {
            $requete->execute();
            return $requete->fetchAll();
        } catch (Exception $e) {
            // Log l'erreur au lieu de l'afficher
            error_log('Erreur dans getFoods : ' . $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }

    /**
     * @return array
     */
    public function getFoodsActive() {

        global $db;

        // Pas de SELECT * car prend de la ressource inutilement
        $requete = $db->prepare("SELECT tbl_food.id, tbl_food.title, tbl_food.description, tbl_food.price, tbl_food.image_name, tbl_food.category_id, tbl_food.featured, tbl_food.active FROM  tbl_food WHERE active= 'yes'");

        try {
            $requete->execute();
            return $requete->fetchAll();
        } catch (Exception $e) {
            // Log l'erreur au lieu de l'afficher
            error_log('Erreur dans getFoodsActive : ' . $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }

    /**
     * Retourne un plat
     * @return array
     */
    public function getFood($food_id) {

        global $db;

        // Pas de SELECT * car prend de la ressource inutilement
        $requete = $db->prepare("SELECT tbl_food.id, tbl_food.title, tbl_food.description, tbl_food.price, tbl_food.image_name, tbl_food.category_id, tbl_food.featured, tbl_food.active FROM  tbl_food WHERE id = :id");

        try {

            $requete->bindValue(':id', $food_id);
            $requete->execute();
            return $requete->fetch();
        } catch (Exception $e) {
            // Log l'erreur au lieu de l'afficher
            error_log('Erreur dans getFoods : ' . $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }

    /**
     * Retourne les plats par catégorie
     * @return string
     */
    public function categoryName($category_id) {

        global $db;

        $requete = $db->prepare("SELECT tbl_category.title FROM tbl_category WHERE id = :category_id");

        try {

            $requete->bindValue(':category_id', $category_id);
            $requete->execute();
            $result = $requete->fetch();

            // Vérifier si le résultat est non vide et retourner le titre
            return $result ? $result['title'] : null;

        } catch (Exception $e) {
            // Log l'erreur au lieu de l'afficher
            error_log('Erreur dans categoryName : ' . $e->getMessage());
            return null; // Retourne null en cas d'erreur ou si aucun résultat n'est trouvé
        }
    }

    /**
     * Retourne les plats par catégorie
     * @return array
     */
    public function getFoodsBycategory($category_id) {

        global $db;

        // Pas de SELECT * car prend de la ressource inutilement
        $requete = $db->prepare("SELECT tbl_food.id, tbl_food.title, tbl_food.description, tbl_food.price, tbl_food.image_name, tbl_food.category_id, tbl_food.featured, tbl_food.active FROM  tbl_food WHERE category_id = :category_id AND featured='yes' LIMIT 6");

        try {
            $requete->bindValue(':category_id', $category_id);
            $requete->execute();
            return $requete->fetchAll();
        } catch (Exception $e) {
            // Log l'erreur au lieu de l'afficher
            error_log('Erreur dans getFoodsBycategory : ' . $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }

    /**
     * Retourne les catégories des plats
     * @return array
     */
    public function getCategoryFoods() {

        global $db;

        // Pas de SELECT * car prend de la ressource inutilement
        $requete = $db->prepare("SELECT tbl_category.id, tbl_category.title, tbl_category.image_name, tbl_category.featured, tbl_category.active FROM  tbl_category WHERE active= 'yes'");

        try {
            $requete->execute();
            return $requete->fetchAll();
        } catch (Exception $e) {
            // Log l'erreur au lieu de l'afficher
            error_log('Erreur dans getCategoryFoods : ' . $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }

    /**
     * Recherche des plats par titre ou description.
     *
     * @param string $search Le terme de recherche.
     * @return array Les résultats de la recherche ou un tableau vide si aucun plat n'est trouvé.
     */
    public function searchFoods($search) {

        global $db;

        $sql = "SELECT tbl_food.id, tbl_food.title, tbl_food.description, tbl_food.price, tbl_food.image_name, tbl_food.category_id, tbl_food.featured, tbl_food.active FROM tbl_food WHERE title LIKE :search OR description LIKE :search";
        $q = $db->prepare($sql);
        $searchValue = "%" . $search . "%";
        $q->bindValue(':search', $searchValue);
        $q->execute();
        $count = $q->rowCount();

        if ($count > 0) {
            // Plats disponibles
            return $q->fetchAll();
        } else {
            // Aucun plat trouvé
            return [];
        }
    }

    /**
     * Sauvegarde une nouvelle commande
     * 
     * @param mixed éléments de la commande
     */
    public function saveOrder($food, $price, $qty, $total, $order_date, $status, $customer_name, $customer_contact, $customer_email, $customer_address) {

        global $db;

        $requete = $db->prepare("
            INSERT INTO tbl_order SET
            food              = :food,
            price             = :price,
            qty               = :qty,
            total             = :total,
            order_date        = :order_date,
            status            = :status,
            customer_name     = :customer_name,
            customer_contact  = :customer_contact,
            customer_email    = :customer_email,
            customer_address  = :customer_address
        ");

        try {
            $requete->execute([
                ':food'             => $food,
                ':price'            => $price,
                ':qty'              => $qty,
                ':total'            => $total,
                ':order_date'       => $order_date,
                ':status'           => $status,
                ':customer_name'    => $customer_name,
                ':customer_contact' => $customer_contact,
                ':customer_email'   => $customer_email,
                ':customer_address' => $customer_address
            ]);

            return true;

        } catch (Exception $e) {
            echo 'Erreur : ',  $e->getMessage(), "\n";

            return false;
        }  
    }
}
