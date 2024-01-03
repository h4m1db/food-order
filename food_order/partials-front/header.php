<?php
// include('config/constants.php');
include('config/init.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="	Redécouvrez la cuisine québécoise avec le restaurant XX. 
                                        Notre chef utilise des ingrédients locaux ravir vos papilles. 
                                        Réservez votre table dès maintenant!">
    <meta name="keywords" content="Pizza,MoMo,Hamburger,Burger,Eat,Order">
    <meta name="author" content="Mehdi Kerkar">
    <meta http-equiv="refresh" content="30">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?= SITEURL; ?>" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?= SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?= SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?= SITEURL; ?>foods.php">Foods</a>
                    </li>

                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->