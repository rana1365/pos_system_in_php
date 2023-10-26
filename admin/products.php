<?php include('inc/header.php'); ?>


<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Products
                <a href="products-create.php" class="btn btn-primary float-end">Add Product</a>

            </h4>
        </div>

        <div class="card-body">
            <?php alertMessage(); ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered mt-3">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $products = getAll('products');

                    if (!$products) { ?>
                        <h4 class="mb-0">Access Denied.!</h4>

                    <?php }

                    if (mysqli_num_rows($products) > 0) {
                        ?>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td><?= $product['id'] ?></td>
                                <td>
                                    <img src="../<?= $product['image'];?>" style="width: 50px;height: 50px;" alt="Img">
                                </td>
                                <td><?= $product['name'] ?></td>
                                <td>
                                    <?php
                                    if ($product['status'] == 0) {

                                        echo '<a href = "active-status.php?id='.$product['id'].'&status=0" class="btn btn-primary btn-sm">Visible</a>';

                                    } else{

                                        echo '<a href = "active-status.php?id='.$product['id'].'&status=1" class="btn btn-danger btn-sm">Hidden</a>';

                                    }
                                    ?>
                                </td>

                                <td>
                                    <a href="products-edit.php?id=<?=$product['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="products-delete.php?id=<?=$product['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php
                    }else {

                        ?>
                        <tr>
                            <h4 class="mb-0">No Record Found.!</h4>
                        </tr>
                        <?php

                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<?php include('inc/footer.php'); ?>
