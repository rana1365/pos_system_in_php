<?php


include('../config/function.php');

if (!isset($_SESSION['productItems'])) {
    $_SESSION['productItems'] = [];
}

if (!isset($_SESSION['productItemId'])) {
    $_SESSION['productItemId'] = [];
}

if (isset($_POST['addItem'])) {

    $product_id = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']);


    $checkProduct = mysqli_query($conn, "SELECT * FROM products WHERE id = '$product_id' LIMIT 1 ");

    if ($checkProduct) {

        if (mysqli_num_rows($checkProduct) > 0) {

            $product_data = mysqli_fetch_assoc($checkProduct);

            if ($product_data['quantity'] < $quantity) {

                redirect('order-create.php', 'only' .$product_data['quantity']. 'quantity available');

            }

            $data =
                [
                    'product_id' => $product_data['id'],
                    'name' => $product_data['name'],
                    'image' => $product_data['image'],
                    'price' => $product_data['price'],
                    'quantity' => $quantity,
                ];

            if (!in_array($product_data['id'], $_SESSION['productItemId'] )) {

                array_push($_SESSION['productItemId'], $product_data['id']);
                array_push($_SESSION['productItems'], $data);

            } else {

                foreach ($_SESSION['productItems'] as $key => $prodSessionItem) {

                    if ($prodSessionItem['product_id'] == $product_data['id']) {

                        $newQuantity = $prodSessionItem['quantity'] + $quantity;

                        $data =
                            [
                                'product_id' => $product_data['id'],
                                'name' => $product_data['name'],
                                'image' => $product_data['image'],
                                'price' => $product_data['price'],
                                'quantity' => $newQuantity,
                            ];

                        $_SESSION['productItems'][$key] = $data;

                    }

                }

            }

            redirect('order-create.php', 'Item Added '.$product_data['name']);


        } else {
            redirect('order-create.php', 'No Such Product Found');
        }

    } else {

        redirect('order-create.php', 'Something went wrong.!');
    }


//    $result = insert('products', $data);
//
//    if ($result) {
//
//        redirect('products.php', 'Product has created Successfully!.');
//
//    } else {
//
//        redirect('products-create.php', 'Something Went Wrong!.');
//
//    }
}

if (isset($_POST['productIncDec'])) {

    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']);

    $flag = false;
    foreach ($_SESSION['productItems'] as $key => $item) {

        if ($item['product_id'] == $productId) {
            $flag = true;
            $_SESSION['productItems'][$key]['quantity'] = $quantity;
        }
    }

    if ($flag) {

        jsonResponse(200, 'success', 'Quantity Updated.!');

    } else {

        jsonResponse(500, 'error', 'Something went wrong.!');

    }
}

if (isset($_POST['proceedToPlaceBtn'])) {

    $phone = validate($_POST['cphone']);
    $payment_mode = validate($_POST['payment_mode']);

    //checking Customer
    $checkCustomer = mysqli_query($conn, " SELECT phone FROM customers WHERE phone = '$phone' LIMIT 1 ");

    if ($checkCustomer) {

        if (mysqli_num_rows($checkCustomer) > 0) {

            $_SESSION['invoice_no'] = "INV-".rand(111111,999999);
            $_SESSION['cphone'] = $phone;
            $_SESSION['payment_mode'] = $payment_mode;

            jsonResponse (200, 'success', 'Customer has Found.!');

        } else {
            $_SESSION['cphone'] = $phone;
            jsonResponse (404, 'warning', 'Customer Not Found.!');
        }
    } else {

        jsonResponse (500, 'error', 'Something Went Wrong.!');
    }
}

if (isset($_POST['saveCustomerBtn'])) {

    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);

    if ($name != '' && $phone != '') {

        $data =
            [
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
            ];

        $result = insert('customers', $data);

        if ($result) {

            jsonResponse(200, 'success', 'Customer added successfully.!');

        } else {
            jsonResponse(500, 'error', 'Something Went Wrong.!');
        }

    } else {

        jsonResponse(422, 'warning', 'Please Fill Required Fields');
    }
}


if (isset($_POST['saveOrder'])) {

    $phone = validate($_SESSION['cphone']);
    $invoice_no = validate($_SESSION['invoice_no']);
    $payment_mode = validate($_SESSION['payment_mode']);
    $order_placed_by_id = $_SESSION['loggedInUser']['user_id'];

    $checkCustomer = mysqli_query($conn, " SELECT * FROM customers WHERE phone = '$phone' LIMIT 1 ");

    if (!$checkCustomer) {
        jsonResponse(500, 'error', 'Something Went Wrong.!');

    }

    if (mysqli_num_rows($checkCustomer) > 0) {
        $customerData = mysqli_fetch_assoc($checkCustomer);

        if (!isset($_SESSION['productItems'])) {
            jsonResponse(404, 'warning', 'No Items to Place Order.!');

        }

        $sessionProducts = $_SESSION['productItems'];
        $totalAmount = 0;
        foreach ($sessionProducts as $sessionProduct) {

            $totalAmount += $sessionProduct['price'] * $sessionProduct['quantity'];
        }


        $data =
            [
                'customer_id' => $customerData['id'],
                'tracking_no' => rand(11111,99999),
                'invoice_no' => $invoice_no,
                'total_amount' => $totalAmount,
                'order_date' => date('Y-m-d'),
                'order_status' => 'placed',
                'payment_mode' => $payment_mode,
                'order_placed_by_id' => $order_placed_by_id,
            ];

        $result = insert('orders', $data);
        $lastOrderId = mysqli_insert_id($conn);
        foreach ($sessionProducts as $prodItem) {

            $productId = $prodItem['product_id'];
            $price = $prodItem['price'];
            $quantity = $prodItem['quantity'];

            // Inserting orderItems

            $orderItemData =
                [
                    'order_id' => $lastOrderId,
                    'product_id' => $productId,
                    'price' => $price,
                    'quantity' => $quantity,
                ];

            $orderItemResult = insert('order_items', $orderItemData);
            //checking Placed quantity and decreased quantity and making the total quantity
            $checkProductQty = mysqli_query($conn," SELECT * FROM products WHERE id='$productId'");
            $productQty = mysqli_fetch_assoc($checkProductQty);
            $totalProductQty = $productQty['quantity'] - $quantity;

            $dataUpdate =
                [
                    'quantity' => $totalProductQty
                ];

            $updateProductQty = update('products', $productId, $dataUpdate);
        }

        unset($_SESSION['productItemId']);
        unset($_SESSION['productItems']);
        unset($_SESSION['cphone']);
        unset($_SESSION['payment_mode']);
        unset($_SESSION['invoice_no']);

        jsonResponse(200, 'success', 'Order Placed Successfully.!');

    } else {
        jsonResponse(404, 'warning', 'No Customer Found.!');

    }
}
