<?php include_once('partials/header.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br /><br />

        <a href="<?= SITEURL; ?>admin/add-food.php" class=" btn-primary">Add Food</a>
        <br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>

                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>

            </tr>
            <?php
            $sn = 1; // creation d'une variable pour l'affichage du SN
            $sql = "SELECT * FROM tbl_food";
            //On exécute la requete
            $q = $db->query($sql);
            $foods = $q->fetchAll();

            ?>
            <?php foreach ($foods as $food) : ?>
                <tr>
                    <td><?= $sn++ ?></td>
                    <td><?= $food['title'] ?></td>
                    <td><?= $food['description'] ?></td>
                    <td><?= $food['price'] ?> $</td>
                    <td>
                        <img src="<?= SITEURL; ?>images/food/<?= $food['image_name']; ?>" alt="<?= $food['title'] ?>" class="img-w-100">

                    </td>

                    <td><?= $food['featured'] ?></td>
                    <td><?= $food['active'] ?></td>
                    <td>
                        <a href="<?= SITEURL; ?>admin/update-food.php?id=<?= $food['id']; ?>" class="btn-secondary">Update food</a>
                        <a href="<?= SITEURL; ?>admin/delete-food.php?id=<?= $food['id']; ?>&image_name=<?= $food['image_name']; ?>" class="btn-danger">Delete food</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php include_once('partials/footer.php') ?>