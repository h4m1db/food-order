<?php
include('../config/init.php');
if (isset($_GET['id']) && $_GET['image_name']) {

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the image file physicaly
    $path = "../images/category/" . $image_name;
    $remove = unlink($path);



    $sql = "DELETE FROM tbl_category WHERE id=$id";


    $q = $db->prepare($sql);
    $q->execute();
    header("location:" . SITEURL . 'admin/manage-category.php');
}
header("location:" . SITEURL . 'admin/manage-category.php');
