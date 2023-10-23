<?php include('inc/header.php'); ?>


    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0"> Edit Admin

                    <a href="admins.php" class="btn btn-danger float-end">Back</a>

                </h4>
            </div>

            <div class="card-body">
                <?php alertMessage(); ?>

                <form action="code.php" method="POST">

                    <?php

                        if (isset($_GET['id'])) {

                            if ($_GET['id'] != '') {

                                $admin_id = $_GET['id'];

                            } else {
                                echo '<h5>No Id Found.!</h5>';
                                return false;
                            }
                        } else {
                            echo '<h5>No Id were given.</h5>';
                            return false;
                        }

                        $admin_data = getById('admins', $admin_id);
                        if ($admin_data) {

                            if ($admin_data['status'] == 200) {

                                ?>

                                <input type="hidden" name="admin_id" value="<?= $admin_data['data']['id'];?>" />

                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label for="Name">Name *</label>
                                        <input type="text" name="name" value="<?= $admin_data['data']['name']; ?>" class="form-control" required />
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="Email">Email *</label>
                                        <input type="email" name="email" value="<?= $admin_data['data']['email']; ?>" class="form-control" required />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="Phone">Phone *</label>
                                        <input type="number" name="phone" value="<?= $admin_data['data']['phone'] ?>" class="form-control" />
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="Name">Password *</label>
                                        <input type="password" name="password" class="form-control" />
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="Name">Is Ban </label>
                                        <input type="checkbox" name="is_ban" value="<?= $admin_data['data']['is_ban'] == true ? 'checked':''; ?>" style="width: 15px;height: 15px;" />
                                    </div>

                                    <div class="col-md-12 mb-3 text-end">
                                        <button type="submit" name="updateAdmin" class="btn btn-primary">Update</button>
                                    </div>


                                </div>

                                <?php


                            } else {

                                echo '<h5>'.$admin_data['message'].'</h5>';

                            }

                        } else {
                            echo 'Something went Wrong.!';
                            return false;
                        }

                    ?>

                </form>

            </div>

        </div>
    </div>


<?php include('inc/footer.php'); ?>