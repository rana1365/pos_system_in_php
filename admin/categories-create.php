<?php include('inc/header.php'); ?>


<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Categories

                <a href="admins.php" class="btn btn-success float-end">Back</a>

            </h4>
        </div>

        <div class="card-body">
            <?php alertMessage(); ?>

            <form action="categories-code.php" method="POST">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="Name">Name *</label>
                        <input type="text" name="name" class="form-control" required />
                    </div>

                    <div class="col-md-8 mb-3">
                        <label for="Email">Description </label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="Status">Status </label>
                        <input type="checkbox" name="status" style="width: 15px;height: 15px;" />
                    </div>

                    <div class="col-md-12 mb-3 text-end">
                        <button type="submit" name="saveCategory" class="btn btn-primary">Save</button>
                    </div>


                </div>
            </form>

        </div>

    </div>
</div>


<?php include('inc/footer.php'); ?>