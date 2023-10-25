<?php include('inc/header.php'); ?>


    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Categories
                    <a href="categories-create.php" class="btn btn-primary float-end">Add Category</a>

                </h4>
            </div>

            <div class="card-body">
               <?php alertMessage(); ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-3">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $categories = getAll('categories');

                        if (!$categories) { ?>
                            <h4 class="mb-0">Access Denied.!</h4>

                        <?php }

                        if (mysqli_num_rows($categories) > 0) {
                            ?>
                            <?php foreach ($categories as $category) : ?>
                                <tr>
                                    <td><?= $category['id'] ?></td>
                                    <td><?= $category['name'] ?></td>
                                    <td>
                                        <?php
                                        if ($category['status'] == 0) {

                                            echo '<a href = "active-status.php?id='.$category['id'].'&status=0" class="btn btn-primary btn-sm">Visible</a>';

                                        } else{

                                            echo '<a href = "active-status.php?id='.$category['id'].'&status=1" class="btn btn-danger btn-sm">Hidden</a>';

                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <a href="categories-edit.php?id=<?=$category['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <a href="categories-delete.php?id=<?=$category['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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

            <h2> Welcome to the paramoy Life</h2>

        </div>
    </div>


<?php include('inc/footer.php'); ?>