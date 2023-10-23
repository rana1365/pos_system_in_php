<?php include('inc/header.php'); ?>


<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Admin/Staff
                <a href="admins-create.php" class="btn btn-primary float-end">Add Admin</a>

            </h4>
        </div>

        <div class="card-body">
            <?php alertMessage(); ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $admins = getAll('admins');

                    if (!$admins) { ?>
                        <h4 class="mb-0">Access Denied.!</h4>

                    <?php }

                        if (mysqli_num_rows($admins) > 0) {
                        ?>
                    <?php foreach ($admins as $admin) : ?>
                        <tr>
                            <td><?= $admin['id'] ?></td>
                            <td><?= $admin['name'] ?></td>
                            <td><?= $admin['email'] ?></td>
                            <td><?= $admin['phone'] ?></td>
                            <td>
                                <a href="admins-edit.php?id=<?=$admin['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="admins-delete.php" class="btn btn-danger btn-sm">Delete</a>
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