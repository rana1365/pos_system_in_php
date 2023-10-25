<?php include('inc/header.php'); ?>


    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Categories

                    <a href="categories.php" class="btn btn-danger float-end">Back</a>

                </h4>
            </div>

            <div class="card-body">
                <?php alertMessage(); ?>

                <form action="categories-code.php" method="POST">

                    <?php
                        $category_id = checkParam('id');
                        if (!is_numeric($category_id)) {
                            echo '<h5>'.$category_id.'</h5>';
                            return false;
                        }

                        $category_data = getById('categories', $category_id);

                        if ($category_data['status'] == 200) {


                    ?>
                    <input type="hidden" name="category_id" value="<?= $category_data['data']['id'];?>" />

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="Name">Name *</label>
                            <input type="text" name="name" value="<?= $category_data['data']['name'];?>" class="form-control" required />
                        </div>

                        <div class="col-md-8 mb-3">
                            <label for="Email">Description </label>
                            <textarea name="description"  class="form-control" rows="3"><?= $category_data['data']['description'];?></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Status">Status </label>
                            <input type="checkbox" name="status" value="<?= $category_data['data']['status'] == true ? 'checked' : '' ;?>" style="width: 15px;height: 15px;" />
                        </div>

                        <div class="col-md-12 mb-3 text-end">
                            <button type="submit" name="updateCategory" class="btn btn-primary">Update</button>
                        </div>


                    </div>
                            <?php

                            } else {

                            echo '<h5>'.$category_data['message'].'</h5>';
                        }
                        ?>
                </form>

            </div>

        </div>
    </div>


<?php include('inc/footer.php'); ?>