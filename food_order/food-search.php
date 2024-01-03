<?php
include('partials-front/header.php');
include('src/ClassFood.php');

//get the search keyword
if(isset($_POST['search'])) {
    $search = $_POST['search']; 
} else {
    $search = ''; 
}

// instantiation de la classe Food
$food = new Food();

$foods = $food->searchFoods($search);
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on Your Search <a href="#" class="text-white"><?= $search ?></a></h2>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <?php if (count($foods) > 0) : ?>
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

                        <a href="<?= SITEURL; ?>order.php?food_id=<?= $food['id'] ?>" class="btn btn-primary" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
            <?php endforeach; ?>
        
        <?php else : ?>
            <p class="center" >Aucun résultat trouvé pour la recherche</p>
        <?php endif; ?>

        <div class="clearfix"></div>
    </div>

</section>
<!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>