<?php
include_once('partials/header.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <!-- form -->

        <form  method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category tilte">
                    </td>

                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="food description"></textarea>
                    </td>

                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" step=".01" name="price" placeholder="food price">
                    </td>

                </tr>
                <tr>
                    <td>Select image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            //display active categories from db
                            $sql = "SELECT * FROM tbl_category WHERE active='yes'";
                            $q = $db->prepare($sql);
                            $q->execute();

                            $count = $q->rowCount();
                            if ($count > 0) {
                                //We have categories
                                $actives = $q->fetchAll();
                            ?>
                                <?php foreach ($actives as $active) : ?>
                                    <option value="<?= $active['id'] ?>"><?= $active['title'] ?></option>
                                <?php endforeach; ?>
                            <?php
                            } else {
                                // no categories
                            ?>
                                <option value="0">No category found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="yes"> Yes
                        <input type="radio" name="featured" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes"> Yes
                        <input type="radio" name="active" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>


<?php
//Form Gestion 

//Vérification du submit
if (isset($_POST['submit'])) {
    //boutton cliqué
    //echo "bouton cliqué";

    //Récupperé les donnés du form 

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $category = $_POST['category'];
    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        //set default value
        $featured = "no";
    }
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        //set default value
        $active = "no";
    }

    if (isset($_FILES['image']['name'])) {
        //upload the image
        $allowed = [
            "jpg" => "image/jpeg",
            "jpeg" => "image/jpeg",
            "png" => "image/png",
        ];

        $image_name = $_FILES['image']['name'];
        $filetype = $_FILES["image"]["type"];
        $filesize = $_FILES["image"]["size"];

        $extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        //on verifie l'absence de l'extension dans les clés de $allowed ou du type mime
        if (!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)) {
            // extension ou type incorect
            die("Erreur : format du fichier incorecte");
        }
        //le tpe est correct


        //unique nameming
        $newname = md5(uniqid());
        $newfilename = "$newname.$extension";
        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/food/" . $newfilename;

        $upload = move_uploaded_file($source_path, $destination_path);
        //cheak if the image is upload
        if ($upload == false) {
            $_SESSION['upload'] = "<div> Failed to Upload the image; </div>";
            header("location:" . SITEURL . 'admin/add-food.php');
            //Stop the procces
            die();
        }

        //we stop files execution
        chmod($newfilename, 0644);
    } else {
        // don't upload the image + set the image_name value as blank
        $image_name = "";
    }




    //SQL Query




    //sql query
    $sql = "INSERT INTO tbl_food(title, description, price, image_name, category_id, featured, active) VALUES
                (:title, :description, :price, :image_name, :category, :featured, :active)";


    $q = $db->prepare($sql);
    $q->bindValue(":title", $title);
    $q->bindValue(":description", $description);
    $q->bindValue(":price", $price);
    $q->bindValue(":image_name", $newfilename);
    $q->bindValue(":category", $category);
    $q->bindValue(":featured", $featured);
    $q->bindValue(":active", $active);
    $q->execute();

    if ($q == true) {
        //succes
        header("location:" . SITEURL . 'admin/manage-food.php');
    } else {
        //failed

        header("location:" . SITEURL . 'admin/add-food.php');
    }
}


?>


<?php

include_once('partials/footer.php');
?>