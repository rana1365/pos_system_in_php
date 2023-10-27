<?php

require '../config/function.php';

$paramResult = checkParam('id');

if (is_numeric($paramResult)) {

    $product_id = validate($paramResult);
//    echo $admin_id;

    $product_data = getById('products', $product_id);

    if ($product_data['status'] == 200) {

        $product_delete_response = delete('products', $product_id);

        if ($product_delete_response) {

            $deleteImage = "../".$product_data['data']['image'];

            if(file_exists($deleteImage)) {
                unlink($deleteImage);
            }

            redirect('products.php', 'product deleted Successfully.!');
        } else {

            redirect('products.php', 'Something Went Wrong.!');
        }

    } else {

        redirect('products.php', $product_data['message']);
    }

} else {

    redirect('products.php', 'Something Went Wrong.!');
}
