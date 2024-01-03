<?php
include('../config/init.php');
include('src/ClassAdmin.php');
$admin = new Admin();

if (isset($_POST['submit'])) {

    // Données récoltées du formulaire
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST["password"];

    // J'update les informations de l'admin
    $process = $admin->addAdmin($full_name, $username, $password);

    // Si l'update s'est bien déroulée
    if ($process == true) {
        //message de confirmation
        $_SESSION['add'] = "<span class='success'><strong>$full_name</strong> ajouté avec succès.</span>";
        //redirection  
        header("location:" . SITEURL . 'admin/manage-admin.php'); exit;

    } else {
        $_SESSION['add'] .= "<span class='error'>Erreur, merci de recommencer l'opération.</span>";
        header("location:" . SITEURL . 'admin/manage-admin.php'); exit;
    }
}

?>