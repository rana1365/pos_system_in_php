<?php include('inc/header.php'); ?>


    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Customers
                    <a href="customers-create.php" class="btn btn-primary float-end">Add Customer</a>

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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $customers = getAll('customers');

                        if (!$customers) { ?>
                            <h4 class="mb-0">Access Denied.!</h4>

                        <?php }

                        if (mysqli_num_rows($customers) > 0) {
                            ?>
                            <?php foreach ($customers as $customer) : ?>
                                <tr>
                                    <td><?= $customer['id'] ?></td>
                                    <td><?= $customer['name'] ?></td>
                                    <td><?= $customer['email'] ?></td>
                                    <td><?= $customer['phone'] ?></td>
                                    <td>
                                        <?php
                                        if ($customer['status'] == 0) {

                                            echo '<a href = "active-status.php?id='.$customer['id'].'&status=0" class="btn btn-primary btn-sm">Visible</a>';

                                        } else{

                                            echo '<a href = "active-status.php?id='.$customer['id'].'&status=1" class="btn btn-danger btn-sm">Hidden</a>';

                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <a href="customers-edit.php?id=<?=$customer['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <a href="customers-delete.php?id=<?=$customer['id']; ?>"
                                           class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete it.?')"
                                        >

                                            Delete

                                        </a>
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