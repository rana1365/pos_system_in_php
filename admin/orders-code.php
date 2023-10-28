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


    $result = insert('products', $data);

    if ($result) {

        redirect('products.php', 'Product has created Successfully!.');

    } else {

        redirect('products-create.php', 'Something Went Wrong!.');

    }
}
