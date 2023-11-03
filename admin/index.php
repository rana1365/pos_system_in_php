<?php include('inc/header.php'); ?>


<div class="container-fluid px-4">
<h1 class="mt-4">Dashboard</h1>

<div class="row mt-5">
    <div class="col-md-3">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <h5 class="text-center">Total Categories</h5>
                <div class="card-footer d-flex align-items-center justify-content-center">
                    <h1 class="text-white text-center stretched-link" >
                        <?= getCount('categories'); ?>
                    </h1>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">
                <h5 class="text-center">Total Products</h5>
                <div class="card-footer d-flex align-items-center justify-content-center">
                    <h1 class="text-white text-center stretched-link" >
                        <?= getCount('products'); ?>
                    </h1>
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <h5 class="text-center">Total Orders</h5>
                <div class="card-footer d-flex align-items-center justify-content-center">
                    <h1 class="text-white text-center stretched-link" >
                        <?= getCount('orders'); ?>
                    </h1>
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-info text-white mb-4">
            <div class="card-body">
                <h5 class="text-center">Total Customers</h5>
                <div class="card-footer d-flex align-items-center justify-content-center">
                    <h1 class="text-white text-center stretched-link" >
                        <?= getCount('customers'); ?>
                    </h1>
                </div>
            </div>

        </div>
    </div>

</div>
</div>


<?php include('inc/footer.php'); ?>