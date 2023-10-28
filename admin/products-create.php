<?php include('inc/header.php'); ?>


    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Add Products

                    <a href="products.php" class="btn btn-success float-end">Back</a>

                </h4>
            </div>

            <div class="card-body">
                <?php alertMessage(); ?>

                <form action="products-code.php" method="POST" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-8">
                            <label class="mb-2" for="Select Category">Select Category</label>
                            <select name="category_id" class="form-select mb-2">
                                <option value="">Select Category</option>
                                <?php

                                    $categories = getAll('categories');
                                    if ($categories) {

                                        if (mysqli_num_rows($categories) > 0) {

                                            foreach ($categories as $category) {

                                                echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';

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
                            <input type="text" name="name" class="form-control" required />
                        </div>

                        <div class="col-md-8 mb-3">
                            <label class="mb-2" for="Email">Description </label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="Price">Price *</label>
                            <input type="text" name="price" class="form-control" required />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="Quantity">Quantity *</label>
                            <input type="text" name="quantity" class="form-control" required />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="Image">Image *</label>
                            <input type="file" name="image" class="form-control" />
                        </div>

                        <div class="col-md-6 mt-4">
                            <label for="Status">Status </label>
                            <input type="checkbox" name="status" style="width: 15px;height: 15px;" />
                        </div>

                        <div class="col-md-12 mb-3 text-end">
                            <button type="submit" name="saveProduct" class="btn btn-primary">Save</button>
                        </div>


                    </div>
                </form>

            </div>

        </div>
    </div>


<?php include('inc/footer.php'); ?>