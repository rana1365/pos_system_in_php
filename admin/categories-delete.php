<?php

require '../config/function.php';

$paramResult = checkParam('id');

if (is_numeric($paramResult)) {

    $category_id = validate($paramResult);

    $category_data = getById('categories', $category_id);

    if ($category_data['status'] == 200) {

        $category_delete_response = delete('categories', $category_id);

        if ($category_delete_response) {

            redirect('categories.php', 'Category deleted Successfully.!');
        } else {

            redirect('categories.php', 'Something Went Wrong.!');
        }

    } else {

        redirect('categories.php', $category_data['message']);
    }

} else {

    redirect('categories.php', 'Something Went Wrong.!');
}
