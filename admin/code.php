<?php

include('../config/function.php');

if (isset($_POST['saveAdmin'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $password = validate($_POST['password']);
    $is_ban = isset($_POST['is_ban']) == true ? 1:0;

    if ($name != '' && $email != '' && $password != '') {
        $emailCheck = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email' ");

        if ($emailCheck) {
            if (mysqli_num_rows($emailCheck) > 0) {
                redirect('admins-create.php', 'Email Already Existed.!');
            }
        }

        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);
        $data =
            [

                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $bcrypt_password,
                'is_ban' => $is_ban

            ];
        $result = insert('admins', $data);

        if ($result) {

            redirect('admins.php', 'Admin has created Successfully!.');

        }else {

            redirect('admins-create.php', 'Something Went Wrong!.');

        }

    }else {
        redirect('admins-create.php', 'Please Fill the Required Fields.');

    }
}


if (isset($_POST['updateAdmin'])) {

    $admin_id = validate($_POST['admin_id']);

    $admin_data = getById('admins', $admin_id);

    if ($admin_data['status'] != 200) {

        redirect('admins-edit.php?id='.$admin_id, 'Please Fill the Required Fields.');

    }
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $password = validate($_POST['password']);
    $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;

    $emailCheckQuery = "SELECT * FROM admins WHERE email = '$email' AND id!='$admin_id'";
    $checkedResult = mysqli_query($conn, $emailCheckQuery);

    if ($checkedResult) {

        if (mysqli_num_rows($checkedResult)) {

            redirect('admins-edit.php?id='.$admin_id, 'Email Already used by another User.!');
        }
    }

    if ($password != '') {

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    } else {

        $hashedPassword = $admin_data['data']['password'];

    }

    if ($name != '' && $email != '') {

        $data =
            [

                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $bcrypt_password,
                'is_ban' => $is_ban

            ];

        $result = update('admins', $admin_id, $data);

        if ($result) {

            redirect('admins-edit.php?id='.$admin_id, 'Admin has Updated Successfully!.');

        }else {

            redirect('admins-create.php?id='.$admin_id, 'Something Went Wrong!.');

        }


    }else {
        redirect('admins-create.php', 'Please Fill the Required Fields.');

    }

}


