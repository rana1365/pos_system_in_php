<?php

include('inc/header.php');

if (!isset($_SESSION['productItems'])) {

    echo '<script> window.location.href = "order-create.php"; </script>';
}

?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0">Order Summery
                        <a href="order-create.php" class="btn btn-danger float-end">Back to Create Order</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php alertMessage(); ?>

                    <div id="myBilling">

                        <?php

                            if (isset($_SESSION['cphone'])) {

                                $phone = validate($_SESSION['cphone']);
                                $invoice_no = validate($_SESSION['invoice_no']);
                                $customerData = mysqli_query($conn, " SELECT * FROM customers WHERE phone = '$phone' LIMIT 1 ");
                                if ($customerData) {
                                    if (mysqli_num_rows($customerData) > 0) {

                                        $customerDetails = mysqli_fetch_assoc($customerData);
                                        ?>

                                        <table style="width: 100%;margin-bottom: 20px;">

                                            <tr>
                                                <td style="text-align: center;" colspan="2">
                                                    <h4 style="font-size: 23px;line-height: 30px;margin: 2px;padding: 0;">ZnZ Fabrics Ltd.</h4>
                                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Zhinu Market, Pagar, Tongi</p>
                                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Zaber and Zubair Fabrics Ltd.</p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <h5 style="font-size: 23px;line-height: 30px;margin: 2px;padding: 0;">Customer Details</h5>
                                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Customer Name: <?= $customerDetails['name']; ?></p>
                                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Customer Phone: <?= $customerDetails['phone']; ?></p>
                                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Customer Email: <?= $customerDetails['email']; ?></p>
                                                </td>

                                                <td align="end">
                                                    <h5 style="font-size: 23px;line-height: 30px;margin: 2px;padding: 0;">Invoice Details</h5>
                                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Invoice Number: <?= $invoice_no; ?></p>
                                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Invoice Date: <?= date('d M Y'); ?></p>
                                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Address: Zhinu Market, Pagar, Tongi</p>
                                                </td>
                                            </tr>

                                        </table>

                                        <?php

                                    } else {
                                        echo '<h5>No Customer Found.!</h5>';
                                        return;
                                    }
                                }
                            }

                        ?>

                        <?php

                        if (isset($_SESSION['productItems'])) {

                            $sessionProducts = $_SESSION['productItems'];
                            ?>

                            <div class="table-responsive mb-3">
                            <table style="width: 100%;" cellpadding="5">
                                <thead>
                                    <tr>
                                        <th align="start" style="border-bottom: 1px solid #ccc;" width="5%">ID</th>
                                        <th align="start" style="border-bottom: 1px solid #ccc;" >Product Name</th>
                                        <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Price</th>
                                        <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Quantity</th>
                                        <th align="start" style="border-bottom: 1px solid #ccc;" width="15%">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                </table>
                            </div>
                            <?php

                        } else {

                            echo '<h5>No Item Added.!</h5>';
                        }

                        ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php

include('inc/footer.php');

?>

