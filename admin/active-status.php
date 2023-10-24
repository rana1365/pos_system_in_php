<?php

require '../config/function.php';

$admin_id = $_GET['id'];

$status = $_GET['is_ban'];

$statusUpdate = "UPDATE admins SET is_ban = '$status' WHERE id = '$admin_id'";

$statusResult = mysqli_query($conn, $statusUpdate);

redirect('admins.php', 'Status Updated.!');
