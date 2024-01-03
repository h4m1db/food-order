<?php 
include_once('partials/header.php'); 
include('src/ClassAdmin.php');

// Instantiation de la classe Admin
$new = new Admin();

if (isset($_GET['id'])) {
    //recuperer l'id de l'admin
    $id = $_GET["id"];

    $admin = $new->getAdmin($id);
} else {
    header('location:' . SITEURL . '/admin/manage-admin.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <form action="update-admin-process.php" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="full_name" value="<?= $admin->full_name ?>"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?= $admin->username ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php include_once('partials/footer.php'); ?>