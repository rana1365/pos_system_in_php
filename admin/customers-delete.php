<?php

require '../config/function.php';

$paramResult = checkParam('id');

if (is_numeric($paramResult)) {

    $customer_id = validate($paramResult);

    $customer_data = getById('customers', $customer_id);

    if ($customer_data['status'] == 200) {

        $customer_delete_response = delete('customers', $customer_id);

        if ($customer_delete_response) {

            redirect('customers.php', 'Customer deleted Successfully.!');
        } else {

            redirect('customers.php', 'Something Went Wrong.!');
        }

    } else {

        redirect('customers.php', $customer_data['message']);
    }

} else {

    redirect('customers.php', 'Something Went Wrong.!');
}
