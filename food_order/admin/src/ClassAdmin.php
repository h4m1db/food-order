<?php
require('../config/init.php');

class Admin {

    /**
     * Connexion à l'administration
     * @return bool
     */
    public function connexionAdmin() {

        global $db;

        $requete = $db->prepare("SELECT * FROM tbl_admin WHERE username = :username");

        try {

            $requete->bindValue(":username", $_POST["username"], PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetch();

        } catch (Exception $e) {
            // Log l'erreur au lieu de l'afficher
            error_log('Erreur dans connexionAdmin : ' . $e->getMessage());
            return false; // Retourne false en cas d'erreur
        }
    }

    /**
     * Retourne les admins
     * @return array
     */
    public function getAdmins() {

        global $db;

        $requete = $db->prepare("SELECT * FROM tbl_admin");

        try {

            $requete->execute();
            return $requete->fetchAll();

        } catch (Exception $e) {
            // Log l'erreur au lieu de l'afficher
            error_log('Erreur dans getAdmins : ' . $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }

    /**
     * Retourne un admin
     * @param string ID de l'admin
     * @return array
     */
    public function getAdmin($id) {

        global $db;

        $requete = $db->prepare("SELECT * FROM tbl_admin WHERE id = :id");

        try {

            $requete->bindValue(":id", $id);
            $requete->execute();
            return $requete->fetch(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            // Log l'erreur au lieu de l'afficher
            error_log('Erreur dans getAdmin : ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Ajoute un admin
     * 
     * @param mixed
     */
    public function addAdmin($full_name, $username, $password) {

        global $db;
        $message = '';

        $requete = $db->prepare("
            INSERT INTO tbl_admin SET
            full_name = :full_name,
            username  = :username,
            password  = :password
        ");

        // Hachage du mot de passe
        $passwordHash = password_hash($_POST["password"], PASSWORD_ARGON2ID);

        // Récupération de tous les admins existants
        $admins = $this->getAdmins();

        // Nous recherchons si le username existe déjà
        foreach($admins as $admin) {
            if ($admin['username'] === $username) {
                // Le nom d'utilisateur existe déjà
                $_SESSION['add'] = "<span class='error'><strong>$username : </strong>Ce nom d'utilisateur existe déjà. </span>";

                // Si le nom d'utilisateur existe déjà, nous retournons false (arrêt du script)
                return false;
            }
        }

        // Si le nom d'utilisateur est libre, le processus continue
        try {
            $requete->execute([
                ':full_name' => $full_name,
                ':username'  => $username,
                ':password'  => $passwordHash
            ]);

            return true;

        } catch (Exception $e) {
            echo 'Erreur : ',  $e->getMessage(), "\n";

            return false;
        }  
    }

    /**
     * Modifie un admin
     * 
     * @param mixed 
     */
    public function updateAdmin($full_name, $username, $id) {

        global $db;

        $requete = $db->prepare("
            UPDATE tbl_admin SET
            full_name = :full_name,
            username  = :username
            WHERE
            id        = :id
        ");

        try {
            $requete->execute([
                ':full_name' => $full_name,
                ':username'  => $username,
                ':id'        => $id
        ]);

            return true;

        } catch (Exception $e) {
            echo 'Erreur : ',  $e->getMessage(), "\n";

            return false;
        }  
    }

    /**
     * Modifie le mot de psse d'un user admin
     * 
     * @param mixed 
     */
    public function updatePasswordAdmin($new_password, $id) {

        global $db;

        $requete = $db->prepare("
            UPDATE tbl_admin SET
            password = :password
            WHERE
            id       = :id
        ");

        // Nouveau mot de passe hash
        $new_password_hash = password_hash($_POST["new_password"], PASSWORD_ARGON2ID);

        try {
            $requete->execute([
                ':password' => $new_password_hash,
                ':id'       => $id
        ]);

            return true;

        } catch (Exception $e) {
            echo 'Erreur : ',  $e->getMessage(), "\n";

            return false;
        }  
    }

 
}
