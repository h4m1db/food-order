<?php
include '../config/init.php';
include 'function.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Document</title>
</head>

<body>

    <div>
        <div>
            <select name="produts" id="products">
    <option value="">All products</option>
    <option value="57">momo</option>
    <option value="54">pizza</option>
    <option value="">All products</option>

            </select>
            <div class="right">
                <h2>All products</h2>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>

                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>

                    </tr>
                    
                        <?php
                        $products = getAllProducts();
                        $sn = 1;
                        ?>
                        <?php foreach ($products as $product) : ?>
                            
                                <tr class="product-wrapper">
                                    <td><?= $sn++ ?></td>
                                    <td><?= $product['title'] ?></td>
                                    <td><?= $product['description'] ?></td>
                                    <td><?= $product['price'] ?></td>
                                    <td><img src="<?= SITEURL; ?>images/food/<?= $product['image_name']; ?>" alt="<?= $product['title'] ?>" width="100px"></td>
                                    <td><?= $product['featured'] ?></td>
                                    <td><?= $product['active'] ?></td>
                                    <td>
                                        <a href="<?= SITEURL; ?>admin/update-food.php?id=<?= $product['id']; ?>" class="btn-secondary">Update food</a>
                                        <a href="<?= SITEURL; ?>admin/delete-food.php?id=<?= $product['id']; ?>&image_name=<?= $product['image_name']; ?>" class="btn-danger">Delete food</a>

                                    </td>
                                </tr>
                            
                        <?php endforeach ?>
                    

                    </tr>

                </table>
            </div>

        </div>
    </div>
    </div>





    <script src="script.js"></script>
</body>

</html>