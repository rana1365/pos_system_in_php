<?php

require '../config/function.php';

$paramResult = checkParam('id');

if (is_numeric($paramResult)) {

    $admin_id = validate($paramResult);
//    echo $admin_id;

    $admin_data = getById('admins', $admin_id);

    if ($admin_data['status'] == 200) {

        $admin_delete_response = delete('admins', $admin_id);

        if ($admin_delete_response) {

            redirect('admins.php', 'Admin deleted Successfully.!');
        } else {

            redirect('admins.php', 'Something Went Wrong.!');
        }

    } else {

        redirect('admins.php', $admin_data['message']);
    }

} else {

    redirect('admins.php', 'Something Went Wrong.!');
}