<?php include_once('partials/header.php'); ?>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_food WHERE id = $id";
            //executer la query
            $q = $db->prepare($sql);

            $q->execute();

            $count = $q->rowCount();


            if ($count == 1) {
                $food = $q->fetch(PDO::FETCH_OBJ);
                
                $current_category = $food->category_id;
            } else {
                header("location:" . SITEURL . 'admin/manage-food.php');
            }
        } else {
            header('location:' . SITEURL . '/admin/manage-food.php');
        }
        ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update food</h1>



        <form  method="POST" enctype="multipart/form-data">
            <table class="tbl30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?= $food->title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?= $food->description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?= $food->price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current image:</td>
                    <td><img src="<?= SITEURL; ?>images/food/<?= $food->image_name; ?>" alt="<?= $food->title; ?>" class="img-w-100"></td>
                </tr>
                <tr>
                    <td>New image:</td>
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
                                    <option <?php if($current_category==$active['id']){echo 'selected';} ?> value="<?= $active['id'] ?>"><?= $active['title'] ?></option>
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
                        <input <?php if ($food->featured == "yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="yes"> Yes
                        <input <?php if ($food->featured == "no") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($food->active == "yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="yes"> Yes
                        <input <?php if ($food->active == "no") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?= $food->image_name; ?>" >
                        <input type="hidden" name="id" value="<?= $id; ?>" >
                        <input type="submit" name="submit" value="Update food" class="btn-secondary">
                    </td>
                </tr>


            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            //boutton cliqué
            //echo "bouton cliqué";

            //Récupperé les donnés du form 
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //upload new image if selected
            if (isset($_FILES['image']['name'])) {
                //get the details

                $image_name = $_FILES['image']['name'];

                //Check if the images is available or not
                if ($image_name != "") {
                    //image is availible
                    //upload the new image

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
                        header("location:" . SITEURL . 'admin/manage-food.php');
                        //Stop the procces
                        die();
                    }

                    //we stop files execution
                    chmod($newfilename, 0644);
                    $image_name = $newfilename;
                    //remove the current image if availible
                    if ($current_image != "") {
                        $remove_path = "../images/food/" . $current_image;
                        $removed = unlink($remove_path);
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }





            //update query
            $sql2 = "UPDATE tbl_food SET 
                    title=:title, description=:description, price=:price, image_name=:image_name, category_id=:category, featured=:featured, active=:active 
                    WHERE id=$id";

            $q2 = $db->prepare($sql2);
            $q2->bindValue(":title", $title);
            $q2->bindValue(":description", $description);
            $q2->bindValue(":price", $price);
            $q2->bindValue(":image_name", $image_name);
            $q2->bindValue(":category", $category);
            $q2->bindValue(":featured", $featured);
            $q2->bindValue(":active", $active);
            $q2->execute();

            if ($q2 == true) {
                //succes
                header("location:" . SITEURL . 'admin/manage-food.php');
            } else {
                //failed

                header("location:" . SITEURL . 'admin/update-food.php');
            }
        }
        ?>
    </div>
</div>

<?php include_once('partials/footer.php'); ?>