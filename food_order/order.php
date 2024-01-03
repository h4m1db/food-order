<?php
include('partials-front/header.php');
include('src/ClassFood.php');
// Instantiation de la classe Food
$foods = new Food();

//check food id
if (isset($_GET['food_id'])) {

    $food_id = $_GET['food_id'];

    $food = $foods->getFood($food_id);

} else {
    header('location:' . SITEURL);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="order-process.php" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <img src="<?= SITEURL; ?>images/food/<?= $food['image_name']; ?>" alt="<?= $food['title']; ?>" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h3><?= $food['title'] ?></h3>
                    <input type="hidden" name="food" value="<?= $food['title']; ?>">
                    <p class="food-price"><?= $food['price'] ?> $</p>
                    <input type="hidden" name="price" value="<?= $food['price']; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full_name" placeholder="E.g. Mehdi Kerkar" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 0645xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. mehdi@kerkar.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>