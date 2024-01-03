<?php
include('../config/init.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_admin WHERE id=$id";


    $q = $db->prepare($sql);
    $q->execute();
    header("location:" . SITEURL . 'admin/manage-admin.php');
}
header("location:" . SITEURL . 'admin/manage-admin.php');
