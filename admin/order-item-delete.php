<?php


include('../config/function.php');

$paramResult = checkParam('index');

if (is_numeric($paramResult)) {

    $indexValue = validate($paramResult);

    if (isset($_SESSION['productItems']) && isset($_SESSION['productItemId']) ) {

        unset($_SESSION['productItems'][$indexValue]);
        unset($_SESSION['productItemId'][$indexValue]);

        redirect('order-create.php', 'Item Removed');
    } else {

        redirect('order-create.php', 'Item not Removed');
    }

} else {

    redirect('order-create.php', 'Param is not numeric');
}
