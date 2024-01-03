<?php 
include_once('partials/header.php'); 
include('src/ClassAdmin.php');
$admin = new Admin();

// Récuperation des données des admin
$admins = $admin->getAdmins();
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage admin</h1>
        <br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //affichage du message
            unset($_SESSION['add']); //retrait du message
        }
        ?>
        
        <!-- button to add admin-->

        <a href="add-admin.php" class=" btn-primary">Add admin</a>
        <br /><br />
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php 
            $sn = 1;
            foreach ($admins as $admin) : 
            ?>
                <tr>
                    <td><?= $sn++ ?></td>
                    <td><?= $admin['full_name'] ?></td>
                    <td><?= $admin['username'] ?></td>
                    <td>
                        <a href="<?= SITEURL; ?>admin/update-password.php?id=<?= $admin['id']; ?>" class="btn-primary">Change Password</a>
                        <a href="<?= SITEURL; ?>admin/update-admin.php?id=<?= $admin['id']; ?>" class="btn-secondary">Update Admin</a>
                        <a href="<?= SITEURL; ?>admin/delete-admin.php?id=<?= $admin['id']; ?>" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>
</div>
<?php include_once('partials/footer.php'); ?>