<?php 
include_once('partials/header.php'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>

<div class="main-container">
    <div class="wrapper">
        <h1>Change Passwords</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //affichage du message
            unset($_SESSION['add']); //retrait du message
        }
        ?>
        <form action="update-password-process.php" method="POST">
            <table class="tbl-30">

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="Enter new password" required>

                    </td>
                </tr>
                <tr>
                    <td>Comfirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm password" required>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <input type="submit" name="submit" value="Change password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php
// if (isset($_POST['submit'])) {


//     $new_password =  $_POST["new_password"];
//     $confirm_password = $_POST["confirm_password"];



//     if ($new_password == $confirm_password) {

//         //get data
//         $id = $_POST["id"];
//         echo $new_password = password_hash($_POST["new_password"], PASSWORD_ARGON2ID);


//         //sql query
//         $sql = "UPDATE tbl_admin SET
//             password=:password 
//             WHERE id =$id";

//         $q = $db->prepare($sql);
//         $q->bindValue(':password', $new_password);
//         $q->execute();

//         if ($q == true) {
//             //succes
//             header("location:" . SITEURL . 'admin/manage-admin.php');
//         } else {
//             //failed

//             header("location:" . SITEURL . 'admin/update-admin.php');
//         }
//     } else {
//         echo "void";
//     }
// }


?>



<?php include_once('partials/footer.php'); ?>