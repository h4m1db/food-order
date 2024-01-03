<?php 
include_once('partials/header.php'); 
include('src/ClassAdmin.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br /><br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //affichage du message
            unset($_SESSION['add']); //retrait du message
        }
        ?>

        <form action="add-admin-process.php" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name" required></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter your username" required></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter your password" required></td>
                </tr>
                <tr>
                    <td colspan="2">

                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php include_once('partials/footer.php'); ?>