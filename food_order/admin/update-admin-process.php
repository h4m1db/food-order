<?php
include('../config/init.php');
include('src/ClassAdmin.php');
$admin = new Admin();

if (isset($_POST['submit'])) {

    // Données
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $id = $_POST['id'];

    // J'update les informations de l'admin
    $process = $admin->updateAdmin($full_name, $username, $id);

    // Si l'update s'est bien déroulée
    if ($process == true) {
        //message de confirmation
        $_SESSION['add'] = "<span class='success'><strong>$full_name</strong> modifié avec succès.</span>";
        //redirection  
        header("location:" . SITEURL . 'admin/manage-admin.php'); exit;

    } else {
        $_SESSION['add'] = "<span class='error'>Erreur, merci de recommencer l'opération.</span>";
        header("location:" . SITEURL . 'admin/manage-admin.php'); exit;
    }
}

?>