<?php include('inc/header.php'); ?>


    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Edit Products

                    <a href="products.php" class="btn btn-danger float-end">Back</a>

                </h4>
            </div>

            <div class="card-body">
                <?php alertMessage(); ?>

                <form action="products-code.php" method="POST" enctype="multipart/form-data">

                    <?php
                    $product_id = checkParam('id');
                    if (!is_numeric($product_id)) {
                        echo '<h5>'.$product_id.'</h5>';
                        return false;
                    }

                    $product_data = getById('products', $product_id);

                    if ($product_data) {

                        if ($product_data['status'] == 200) {

                            ?>

                            <input type="hidden" name="product_id" value="<?= $product_data['data']['id']; ?>" />

                            <div class="row">
                                <div class="col-md-8">
                                    <label class="mb-2" for="Select Category">Select Category</label>
                                    <select name="category_id" class="form-control mb-2">
                                        <option value="">Select Category</option>
                                        <?php

                                        $categories = getAll('categories');
                                        if ($categories) {

                                            if (mysqli_num_rows($categories) > 0) {

                                                foreach ($categories as $category) {
                                                    ?>
                                                    <option value="<?= $category['id']; ?>"
                                                    <?= $product_data['data']['category_id'] == $category['id'] ? 'selected' : ''; ?>
                                                    >
                                                        <?= $category['name']; ?>

                                                    </option>

                                                    <?php

                                                }

                                            } else {

                                                echo '<option value="">Categories Not Found.!</option>';
                                            }

                                        } else {

                                            echo '<option value="">Something Went Wrong.!</option>';
                                        }

                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-8 mb-3">
                                    <label class="mb-2" for="Product Name">Product Name *</label>
                                    <input type="text" name="name" value="<?= $product_data['data']['name'];?>" class="form-control" required />
                                </div>

                                <div class="col-md-8 mb-3">
                                    <label class="mb-2" for="Email">Description </label>
                                    <textarea name="description" class="form-control" rows="3"><?= $product_data['data']['description'];?></textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="mb-2" for="Price">Price *</label>
                                    <input type="text" name="price" value="<?= $product_data['data']['price'];?>" class="form-control" required />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="mb-2" for="Quantity">Quantity *</label>
                                    <input type="text" name="quantity" value="<?= $product_data['data']['quantity'];?>" class="form-control" required />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="mb-2" for="Image">Image *</label>
                                    <input type="file" name="image" class="form-control" />
                                    <img src="../<?= $product_data['data']['image']; ?>" style="width: 50px;height: 50px;" alt="Img" />
                                </div>

                                <div class="col-md-6 mt-4">
                                    <label for="Status">Status </label>
                                    <input type="checkbox" name="status" value="<?= $product_data['data']['status'] == true ? 'checked' : '' ;?>" style="width: 15px;height: 15px;" />
                                </div>

                                <div class="col-md-12 mb-3 text-end">
                                    <button type="submit" name="updateProduct" class="btn btn-primary">Update</button>
                                </div>

                            </div>

                            <?php
                                    } else {

                                        echo '<h5>'.$product_data['message'].'</h5>';

                                    }
                                } else {

                                    echo '<h5>Something Went wrong.!</h5>';
                                    return false;

                                }
                        ?>
                </form>

            </div>

        </div>
    </div>


<?php include('inc/footer.php'); ?>