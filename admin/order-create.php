<?php include('inc/header.php'); ?>


    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Add Orders

                    <a href="orders.php" class="btn btn-success float-end">Back</a>

                </h4>
            </div>

            <div class="card-body">
                <?php alertMessage(); ?>

                <form action="orders-code.php" method="POST">
                    <div class="row">

                        <div class="col-md-5">
                            <label class="mb-2 text-center" for="Select Product">Select Product</label>
                            <select name="product_id" class="form-select mb-2 mySelect2">
                                <option value="">--Select Product--</option>
                                <?php

                                $products = getAll('products');
                                if ($products) {

                                    if (mysqli_num_rows($products) > 0) {

                                        foreach ($products as $products) {

                                            echo '<option value="'.$products['id'].'">'.$products['name'].'</option>';

                                        }

                                    } else {

                                        echo '<option value="">Products Not Found.!</option>';
                                    }

                                } else {

                                    echo '<option value="">Something Went Wrong.!</option>';
                                }

                                ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="Quantity">Quantity *</label>
                            <input type="number" name="quantity" class="form-control" required />
                        </div>

                        <div class="col-md-12 mb-3 text-end">
                            <button type="submit" name="addItem" class="btn btn-primary">Add Item</button>
                        </div>


                    </div>
                </form>

            </div>

        </div>
    </div>


<?php include('inc/footer.php'); ?>