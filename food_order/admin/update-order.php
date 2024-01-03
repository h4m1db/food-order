<?php include('partials/header.php') ?>

<div class="main-content">
    <div class="wraper">
        <h1>Update Order</h1>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_order WHERE id = $id";
            $q = $db->query($sql);
            $q->execute();
            $count = $q->rowCount();
            if ($count == 1) {
                $order = $q->fetch(PDO::FETCH_OBJ);
            }
        } else {
            header('Location:' . SITEURL . 'admin/mange-order.php');
        }

        ?>

        <form  method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?= $order->food; ?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><b><?= $order->price; ?></b></td>
                </tr>
                <tr>
                    <td>Qty.</td>
                    <td>
                        <input type="number" name="qty" value="<?= $order->qty; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($order->status == "Ordered") {
                                        echo "selected";
                                    } ?> value="Ordered">Ordered</option>
                            <option <?php if ($order->status == "On Delivery") {
                                        echo "selected";
                                    } ?> value="On Delivery">On Delivery</option>
                            <option <?php if ($order->status == "Delivered") {
                                        echo "selected";
                                    } ?> value="Delivered">Delivered</option>
                            <option <?php if ($order->status == "Cancelled") {
                                        echo "selected";
                                    } ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?= $order->customer_name; ?>" />
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?= $order->customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="text" name="customer_email" value="<?= $order->customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td>
                        <input type="text" name="customer_address" value="<?= $order->customer_address; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?= $order->id; ?>">
                        <input type="hidden" name="price" value="<?= $order->price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        //check submit btn
        if (isset($_POST['submit'])) {
            //echo "clique";
            //get data from form
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;

            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];

            //save the data in DB
            //sql query

            $sql = "UPDATE tbl_order SET
                qty=:qty,  
                total=:total,  
                status=:status, 
                customer_name=:customer_name, 
                customer_contact=:customer_contact, 
                customer_email=:customer_email,   
                customer_address=:customer_address 
                WHERE id=$id";

            $q = $db->prepare($sql);
            $q->bindValue(':qty', $qty);
            $q->bindValue(':total', $total);
            $q->bindValue(':status', $status);
            $q->bindValue(':customer_name', $customer_name);
            $q->bindValue(':customer_contact', $customer_contact);
            $q->bindValue(':customer_email', $customer_email);
            $q->bindValue(':customer_address', $customer_address);
            $q->execute();

            if ($q == true) {
                //succes
                header("location:" . SITEURL . 'admin/manage-order.php');
            } else {
                //failed

                header("location:" . SITEURL . 'admin/update-order.php');
            }
        }



        ?>


    </div>
</div>

<?php include('partials/footer.php') ?>