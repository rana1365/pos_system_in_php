<?php


include('../config/function.php');

if (isset($_POST['saveProduct'])) {

    $category_id = validate($_POST['category_id']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    if ($_FILES['image']['size'] > 0) {

        $path = "../assets/uploads/products";
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = time().'.'.$image_ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $path."/".$filename);

        $finalImage = "assets/uploads/products/".$filename;
    } else {

        $finalImage = '';
    }

    $data =
        [
            'category_id' => $category_id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'quantity' => $quantity,
            'image' => $finalImage,
            'status' => $status
        ];

    $result = insert('products', $data);

    if ($result) {

        redirect('products.php', 'Product has created Successfully!.');

    } else {

        redirect('products-create.php', 'Something Went Wrong!.');

    }
}
