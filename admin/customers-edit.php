<?php include('inc/header.php'); ?>


<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Customer

                <a href="customers.php" class="btn btn-danger float-end">Back</a>

            </h4>
        </div>

        <div class="card-body">
            <?php alertMessage(); ?>

            <form action="customers-code.php" method="POST">

                <?php
                $customer_id = checkParam('id');
                if (!is_numeric($customer_id)) {
                    echo '<h5>'.$customer_id.'</h5>';
                    return false;
                }

                $customer_data = getById('customers', $customer_id);

                if ($customer_data['status'] == 200) {


                ?>

                <input type="hidden" name="customer_id" value="<?= $customer_data['data']['id'];?>" />

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="Name">Name *</label>
                        <input type="text" name="name" value="<?= $customer_data['data']['name'];?>" class="form-control" required />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="Email">Email </label>
                        <input type="email" name="email" value="<?= $customer_data['data']['email'];?>" class="form-control" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="Phone">Phone </label>
                        <input type="number" name="phone" value="<?= $customer_data['data']['phone'];?>" class="form-control" />
                    </div>


                    <div class="col-md-6 mb-3">
                        <label for="Status">Status </label>
                        <input type="checkbox" name="status" value="<?= $category_data['data']['status'] == true ? 'checked' : '' ;?>" style="width: 15px;height: 15px;" />
                    </div>

                    <div class="col-md-12 mb-3 text-end">
                        <button type="submit" name="updateCustomer" class="btn btn-primary">Update</button>
                    </div>


                </div>

                <?php

                } else {

                echo '<h5>'.$customer_data['message'].'</h5>';
                }
                ?>

            </form>

        </div>

    </div>
</div>


<?php include('inc/footer.php'); ?>
