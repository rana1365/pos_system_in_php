<?php


include('../config/function.php');

if (isset($_POST['saveCustomer'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    $data =
        [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'status' => $status
        ];

    $result = insert('customers', $data);

    if ($result) {

        redirect('customers.php', 'Customer has created Successfully!.');

    } else {

        redirect('customers-create.php', 'Something Went Wrong!.');

    }
}


if (isset($_POST['updateCustomer'])) {

    $customer_id = validate($_POST['customer_id']);

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    $data =
        [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'status' => $status
        ];

    $result = update('customers', $customer_id, $data);

    if ($result) {

        redirect('customers-edit.php?id='.$customer_id, 'Customer has Updated Successfully!.');

    } else {

        redirect('customers-edit.php?id='.$customer_id, 'Something Went Wrong!.');

    }

}