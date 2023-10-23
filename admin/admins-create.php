<?php include('inc/header.php'); ?>


    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Admin/Staff

                    <a href="admins.php" class="btn btn-success float-end">Back</a>

                </h4>
            </div>

            <div class="card-body">
                <?php alertMessage(); ?>

                <form action="code.php" method="POST">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="Name">Name *</label>
                            <input type="text" name="name" class="form-control" required />
                        </div>

                        <div class="col-md-7 mb-3">
                            <label for="Email">Email *</label>
                            <input type="email" name="email" class="form-control" required />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Phone">Phone *</label>
                            <input type="number" name="phone" class="form-control" />
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="Name">Password *</label>
                            <input type="password" name="password" class="form-control" required />
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="Name">Is Ban </label>
                            <input type="checkbox" name="is_ban" style="width: 15px;height: 15px;" />
                        </div>

                        <div class="col-md-12 mb-3 text-end">
                            <button type="submit" name="saveAdmin" class="btn btn-primary">Save</button>
                        </div>


                    </div>
                </form>

            </div>

        </div>
    </div>


<?php include('inc/footer.php'); ?>