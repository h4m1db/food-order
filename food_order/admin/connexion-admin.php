<?php

require("../config/init.php");
include('src/ClassAdmin.php');
$admin = new Admin();

if (isset($_POST['submit'])) {

    $user = $admin->connexionAdmin();

    //verification du user
    if ($user) {
        
        // user exist
        //verification du mdp de user
        if (password_verify($_POST["password"], $user["password"])) {

            $_SESSION['user'] = $user;

            //le mdp est bon
            //on redigire vers une page 
            header("location:" . SITEURL . 'admin/');
        }
    }
}