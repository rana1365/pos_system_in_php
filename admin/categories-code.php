<?php


include('../config/function.php');

if (isset($_POST['saveCategory'])) {
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    $data =
        [
            'name' => $name,
            'description' => $description,
            'status' => $status
        ];

    $result = insert('categories', $data);

    if ($result) {

        redirect('categories.php', 'Category has created Successfully!.');

    } else {

        redirect('categories-create.php', 'Something Went Wrong!.');

    }
}


if (isset($_POST['updateCategory'])) {

    $category_id = validate($_POST['category_id']);

    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    $data =
        [
            'name' => $name,
            'description' => $description,
            'status' => $status
        ];

    $result = update('categories', $category_id, $data);

    if ($result) {

        redirect('categories-edit.php?id='.$category_id, 'Category has Updated Successfully!.');

    } else {

        redirect('categories-edit.php?id='.$category_id, 'Something Went Wrong!.');

    }

}