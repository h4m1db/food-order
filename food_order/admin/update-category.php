<?php include_once('partials/header.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_category WHERE id = $id";
            //executer la query
            $q = $db->prepare($sql);

            $q->execute();

            $count = $q->rowCount();


            if ($count == 1) {
                $category = $q->fetch(PDO::FETCH_OBJ);
            } else {
                header("location:" . SITEURL . 'admin/manage-category.php');
            }
        } else {
            header('location:' . SITEURL . '/admin/manage-category.php');
        }
        ?>

        <form  method="POST" enctype="multipart/form-data">
            <table class="tbl30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?= $category->title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current image:</td>
                    <td><img src="<?= SITEURL; ?>images/category/<?= $category->image_name; ?> " alt="<?= $category->title; ?>" class="img-w-100"></td>
                </tr>
                <tr>
                    <td>New image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($category->featured == "yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="yes"> Yes
                        <input <?php if ($category->featured == "no") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($category->active == "yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="yes"> Yes
                        <input <?php if ($category->active == "no") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?= $category->image_name; ?>" >
                        <input type="hidden" name="id" value="<?= $id; ?>" >
                        <input type="submit" name="submit" value="Update category" class="btn-secondary">
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
            $current_image = $_POST['current_image'];
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
                    $destination_path = "../images/category/" . $newfilename;

                    $upload = move_uploaded_file($source_path, $destination_path);
                    //cheak if the image is upload
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div> Failed to Upload the image; </div>";
                        header("location:" . SITEURL . 'admin/manage-category.php');
                        //Stop the procces
                        die();
                    }

                    //we stop files execution
                    chmod($newfilename, 0644);
                    $image_name = $newfilename;
                    //remove the current image if availible
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;
                        $removed = unlink($remove_path);
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }





            //update query
            $sql2 = "UPDATE tbl_category SET 
                    title=:title, image_name=:image_name, featured=:featured, active=:active 
                    WHERE id=$id";

            $q2 = $db->prepare($sql2);
            $q2->bindValue(":title", $title);
            $q2->bindValue(":image_name", $image_name);
            $q2->bindValue(":featured", $featured);
            $q2->bindValue(":active", $active);
            $q2->execute();

            if ($q2 == true) {
                //succes
                header("location:" . SITEURL . 'admin/manage-category.php');
            } else {
                //failed

                header("location:" . SITEURL . 'admin/update-category.php');
            }
        }
        ?>
    </div>
</div>

<?php include_once('partials/footer.php'); ?>