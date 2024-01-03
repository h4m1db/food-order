<?php
include('partials-front/header.php');
include('src/ClassFood.php');
// Instantiation de la classe Food
$order = new Food();

if (isset($_POST['submit'])) {
    //get the data
    $food = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty;
    $order_date = date("Y-m-d H:i:s"); // order date
    $status = "Ordered";
    $customer_name = $_POST['full_name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];

    $saveOrder = $order->saveOrder($food, $price, $qty, $total, $order_date, $status, $customer_name, $customer_contact, $customer_email, $customer_address);

    if($saveOrder == true) {
        $_SESSION['order'] = "<div class='success text-center'> Food ordered. Thank you.</div>";
        header("location:" . SITEURL);
    } else {
        $_SESSION['order'] = "<div class='error text-center'> We're sorry, an error has occurred. Please try again.</div>";
        header("location:" . SITEURL);
    }

} else {
    header("location:" . SITEURL);
}