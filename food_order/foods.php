<?php
include('partials-front/header.php');
include('src/ClassFood.php');

$new = new Food();
$foods = $new->getFoodsActive();
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?= SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php foreach ($foods as $food) : ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="<?= SITEURL; ?>images/food/<?= $food['image_name']; ?> " alt="<?= $food['title']; ?>" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?= $food['title']; ?></h4>
                    <p class="food-price"><?= $food['price']; ?> $</p>
                    <p class="food-detail">
                        <?= $food['description']; ?>
                    </p>
                    <br>

                    <a href="<?= SITEURL; ?>order.php?food_id=<?= $food['id'] ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
        <?php endforeach; ?>


        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>