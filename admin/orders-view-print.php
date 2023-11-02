<?php include('inc/header.php'); ?>


<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Print Orders
                <a href="orders.php" class="btn  btn-danger btn-sm float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <div id="printMyBilling">
            <?php
                if (isset($_GET['track'])) {

                    $trackingNo = validate($_GET['track']);
                    if ($trackingNo == '') {
                        ?>
                        <div class="text-center py-5">
                            <h5>No Tracking Number Found.!</h5>
                            <div>
                                <a href="orders.php" class="btn btn-primary mt-4 w-25">Go To Order Page</a>
                            </div>
                        </div>
                        <?php
                    }

                    $orderSql = " SELECT o.*,c.* FROM orders o, customers c
                                WHERE c.id=o.customer_id AND tracking_no = '$trackingNo' LIMIT 1 ";
                    $orderResult = mysqli_query($conn, $orderSql);
                    if (!$orderResult) {

                        echo '<h5>Something Went Wrong.!</h5>';
                        return false;
                    }

                    if (mysqli_num_rows($orderResult) > 0) {

                        $orderDataRow = mysqli_fetch_assoc($orderResult);
                        ?>

                        <table style="width: 100%;margin-bottom: 35px;">

                            <tr>
                                <td style="text-align: center;" colspan="2">
                                    <h4 style="font-size: 23px;line-height: 30px;margin: 2px;padding: 0;">ZnZ Fabrics Ltd.</h4>
                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Zhinu Market, Pagar, Tongi</p>
                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Zaber and Zubair Fabrics Ltd.</p>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h6 style="font-size: 19px;line-height: 30px;margin: 2px;padding: 0;">Customer Details</h6>
                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Name: <?= $orderDataRow['name']; ?></p>
                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Phone: <?= $orderDataRow['phone']; ?></p>
                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Email: <?= $orderDataRow['email']; ?></p>
                                </td>

                                <td align="end">
                                    <h6 style="font-size: 19px;line-height: 30px;margin: 2px;padding: 0;">Invoice Details</h6>
                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Invoice Number: <?= $orderDataRow['invoice_no']; ?></p>
                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Invoice Date: <?= date('d M Y'); ?></p>
                                    <p style="font-size: 16px;line-height: 24px;margin: 2px;padding: 0;">Address: Zhinu Market, Pagar, Tongi</p>
                                </td>
                            </tr>

                        </table>

                        <?php

                    } else {

                        echo '<h5>No Records Available.!</h5>';
                        return false;
                    }

                    $orderItemSql = " SELECT oi.quantity as orderItemQuantity, oi.price as orderItemPrice, o.*, oi.*, p.* 
                                    FROM orders o,order_items oi,products p WHERE oi.order_id=o.id
                                    AND p.id=oi.product_id AND o.tracking_no = '$trackingNo' ";
                    $orderItemResult = mysqli_query($conn, $orderItemSql);
                    if ($orderResult) {

                        if (mysqli_num_rows($orderItemResult) > 0) {
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
                                    <tbody>
                                    <?php

                                    $i = 1;
                                    foreach ($orderItemResult as $key => $orderItemRow) :
                                        ?>
                                        <tr>
                                            <td style="border-bottom: 1px solid #ccc;"><?= $i++; ?></td>
                                            <td style="border-bottom: 1px solid #ccc;"><?= $orderItemRow['name']; ?></td>
                                            <td style="border-bottom: 1px solid #ccc;"><?= number_format($orderItemRow['orderItemPrice'], 0); ?></td>
                                            <td style="border-bottom: 1px solid #ccc;"><?= $orderItemRow['orderItemQuantity']; ?></td>
                                            <td style="border-bottom: 1px solid #ccc;" class="fw-bold">

                                                <?= number_format($orderItemRow['orderItemPrice'] * $orderItemRow['orderItemQuantity'] , 0); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="4" align="end" style="font-weight: bold;">Grand Total: </td>
                                        <td colspan="1" style="font-weight: bold;"><?= number_format($orderItemRow['total_amount'], 0); ?></td>
                                    </tr>

                                    <tr>
                                        <td colspan="5">Payment Mode: <?= $orderItemRow['payment_mode']; ?> </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <?php


                        } else {
                            echo '<h5>No Data Found.!</h5>';
                            return false;
                        }

                    } else {
                        echo '<h5>Something Went Wrong.!</h5>';
                        return false;
                    }



                } else {
                    ?>
                    <div class="text-center py-5">
                        <h5>No Tracking Number Found.!</h5>
                        <div>
                            <a href="orders.php" class="btn btn-primary mt-4 w-25">Go To Order Page</a>
                        </div>
                    </div>

                    <?php
                }
            ?>
            </div>
            <div class="mt-4 text-end">
                <button class="btn btn-info px-4 mx-1" onclick="printMyBilling()">Print</button>
                <button class="btn btn-info px-4 mx-1" onclick="downloadPdf('<?= $orderDataRow['invoice_no']; ?>')">Download PDF</button>
            </div>

        </div>

    </div>
</div>


<?php include('inc/footer.php'); ?>
