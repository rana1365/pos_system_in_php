<?php

include('inc/header.php');

?>

    <!-- Modal -->
    <div class="modal fade" id="addCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="c_name" class="mb-1">Enter Customer Name</label>
                        <input type="text" class="form-control" id="c_name" />
                    </div>

                    <div class="mb-3">
                        <label for="c_phone" class="mb-1">Enter Phone Number</label>
                        <input type="text" class="form-control" id="c_phone" />
                    </div>

                    <div class="mb-3">
                        <label for="c_email" class="mb-1">Enter Email (optional)</label>
                        <input type="text" class="form-control" id="c_email" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveCustomerBtn">Save</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Add Orders

                    <a href="orders.php" class="btn btn-danger float-end">Back</a>

                </h4>
            </div>

            <div class="card-body">
                <?php alertMessage(); ?>

                <form action="orders-code.php" method="POST">
                    <div class="row">

                        <div class="col-md-5">
                            <label class="mb-2 text-center" for="Select Product">Select Product</label>
                            <select name="product_id" class="form-select mb-2 mySelect2">
                                <option value="">--Select Product--</option>
                                <?php

                                $products = getAll('products');
                                if ($products) {

                                    if (mysqli_num_rows($products) > 0) {

                                        foreach ($products as $products) {

                                            echo '<option value="'.$products['id'].'">'.$products['name'].'</option>';

                                        }

                                    } else {

                                        echo '<option value="">Products Not Found.!</option>';
                                    }

                                } else {

                                    echo '<option value="">Something Went Wrong.!</option>';
                                }

                                ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="Quantity">Quantity *</label>
                            <input type="number" value="1" name="quantity" class="form-control" required />
                        </div>

                        <div class="col-md-12 mb-3 text-end">
                            <button type="submit" name="addItem" class="btn btn-primary">Add Item</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h4>Products</h4>
            </div>
            <div class="card-body" id="productArea">
                <?php

                    if (isset($_SESSION['productItems'])) {

                        $sessionProducts = $_SESSION['productItems'];

                        if (empty($sessionProducts)) {

                            unset($_SESSION['productItemId']);
                            unset($_SESSION['productItems']);
                        }

                        ?>
                        <div class="table-responsive mb-3" id="productContent">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $i = 1;

                                foreach ($sessionProducts as $key => $item) :
                                    ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td><?= $item['price']; ?></td>
                                        <td>
                                            <div class="input-group qtyBox">
                                                <input type="hidden" value="<?= $item['product_id']; ?>" class="prodId" />
                                                <button class="input-group-text decrement"> - </button>
                                                <input type="text" value="<?= $item['quantity']; ?>" class="qty quantityInput" />
                                                <button class="input-group-text increment"> + </button>
                                            </div>
                                        </td>
                                        <td><?= number_format($item['price'] * $item['quantity'], 0); ?></td>
                                        <td>
                                            <a href="order-item-delete.php?index=<?= $key; ?> " class="btn btn-danger" >Remove</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
            </div>

            <div class="mt-2">
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <label class="mb-2" for="selectPayment"> Select Payment Mode</label>
                        <select id="payment_mode" class="form-select">
                            <option value="Cash Payment">-- Select Payment --</option>
                            <option value="Cash Payment">Cash Payment</option>
                            <option value="Online Payment">Online Payment</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="mb-2" for="Customer Phone">Entry Customer Phone</label>
                        <input type="number" id="cphone" class="form-control" value="" />
                    </div>

                    <div class="col-md-4 mt-2">
                        <br/>
                        <button type="button" class="btn btn-warning w-100 proceedToPlaceBtn">Proceed to Place Order</button>
                    </div>
                </div>
            </div>

            <?php
            } else {
                echo '<h5>No Items added.!</h5>';
            }

            ?>
        </div>

    </div>


<?php

include('inc/footer.php');

?>