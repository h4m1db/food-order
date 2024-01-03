<?php include_once('partials/header.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Categories</h1>
        <br /><br />
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <!-- button to add admin-->

        <a href="add-category.php" class=" btn-primary">Add category</a>
        <br /><br />


        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>

            </tr>
            <?php
            $sn = 1; // creation d'une variable pour l'affichage du SN
            $sql = "SELECT * FROM tbl_category";
            //On exécute la requete
            $q = $db->query($sql);
            $categories = $q->fetchAll();

            ?>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?= $sn++ ?></td>
                    <td><?= $category['title'] ?></td>
                    <td>
                        <img src="<?= SITEURL; ?>images/category/<?= $category['image_name']; ?>" alt="<?= $category['title'] ?>" class="img-w-100">

                    </td>
                    <td><?= $category['featured'] ?></td>
                    <td><?= $category['active'] ?></td>
                    <td>
                        <a href="<?= SITEURL; ?>admin/update-category.php?id=<?= $category['id']; ?>" class="btn-secondary">Update category</a>
                        <a href="<?= SITEURL; ?>admin/delete-category.php?id=<?= $category['id']; ?>&image_name=<?= $category['image_name']; ?>" class="btn-danger">Delete category</a>
                    </td>
                </tr>
            <?php endforeach; ?>


        </table>
    </div>
</div>

<?php include_once('partials/footer.php') ?>