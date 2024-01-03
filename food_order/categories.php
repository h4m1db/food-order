<?php
include('partials-front/header.php');
include('src/ClassFood.php');
// Instantiation de la classe Food
$foods = new Food();

$categories = $foods->getCategoryFoods();
?>

<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php foreach ($categories as $category) : ?>
            <a href="<?= SITEURL; ?>category-foods.php?category_id=<?= $category['id']; ?>">
                <div class="box-3 float-container">
                    <img src="<?= SITEURL; ?>images/category/<?= $category['image_name'];  ?>" alt="<?= $category['title'] ?>" class="img-responsive img-curve">

                    <h3 class="float-text text-white"><?= $category['title'] ?></h3>
                </div>
            </a>
        <?php endforeach; ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include('partials-front/footer.php'); ?>