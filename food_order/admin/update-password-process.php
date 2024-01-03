<?php
include('../config/init.php');
include('src/ClassAdmin.php');
$admin = new Admin();

if (isset($_POST['submit'])) {

    // Récupération de la data
    $id = $_POST["id"];
    $new_password =  $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    if ($new_password == $confirm_password) {
        
        $process_password = $admin->updatePasswordAdmin($new_password, $id);

        if($process_password == true) {

            $user_admin = $admin->getAdmin($id);

            //succes
            $_SESSION['add'] = "<span class='success'>Mot de passe de <strong>[ " . $user_admin->full_name . " ]</strong> modifié avec succès.</span>";
            header("location:" . SITEURL . "admin/manage-admin.php");
        } else {
            //failed
            $_SESSION['add'] .= "<span class='error'>Erreur, merci de recommencer l'opération.</span>";
            header("location:" . SITEURL . "admin/update-password.php");
        }

    } else {
        $_SESSION['add'] .= "<span class='error'>Les mots de passe ne correspondent pas, merci de recommencer l'opération.</span>";
        header("location:" . SITEURL . "admin/update-password.php?id=$id");
    }
}
