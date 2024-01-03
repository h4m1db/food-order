<?php 
include_once('partials/header.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>

        <div class="col-4 text-center">
            <?php
            $sql = "SELECT * FROM tbl_category";
            $q = $db->query($sql);
            $q->execute();
            $count = $q->rowCount();
            ?>
            <h1><?= $count ?></h1>
            <br />
            Categories
        </div>
        <div class="col-4 text-center">
            <?php
            $sql = "SELECT * FROM tbl_food";
            $q = $db->query($sql);
            $q->execute();
            $count = $q->rowCount();
            ?>
            <h1><?= $count ?></h1>
            <br />
            Food
        </div>
        <div class="col-4 text-center">
            <?php
            $sql = "SELECT * FROM tbl_order";
            $q = $db->query($sql);
            $q->execute();
            $count = $q->rowCount();
            ?>
            <h1><?= $count ?></h1>
            <br />
            Total order
        </div>
        <div class="col-4 text-center">
            <?php
            //sql for totale revenue
            //aggregate function
            $sql = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
            $q = $db->query($sql);
            $q->execute();
            $total = $q->fetch();


            ?>
            <h1><?= $total['Total'] ?> $</h1>
            <br />
            Revenue Generated
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php include_once('partials/footer.php') ?>