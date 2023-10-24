<?php

session_start();

require 'connection.php';

/*
 * ---------------------------------------------------------------

        Function: Input Field Validation

 * ----------------------------------------------------------------
*/

function validate($inputData) {

    global $conn;
    $validateData = mysqli_real_escape_string($conn, $inputData);
    return trim($validateData);


}

/*
 * -----------------------------------------------------------------

        Function: Redirection from page to page

 * ------------------------------------------------------------------
*/

function redirect($url, $status) {

    $_SESSION['status'] = $status;
    header('Location: '.$url);
    exit(0);


}

/*
 * -----------------------------------------------------------------

        Function: Displaying messages or status after completing a process

 * ------------------------------------------------------------------
*/

function alertMessage() {

    if (isset($_SESSION['status'])) {
        $_SESSION['status'];
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <h5>'.$_SESSION['status'].'</h5>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        unset($_SESSION['status']);

    }

}


/*
 * -----------------------------------------------------------------

        Function: Insert Records into Database Table

 * ------------------------------------------------------------------
*/

function insert($tableName, $data) {

    global $conn;
    $table = validate($tableName);
    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumn = implode(',', $columns);
    $finalValues = "'".implode("','", $values)."'";

    $query = " INSERT INTO $table ($finalColumn) VALUES ($finalValues) ";
    $result = mysqli_query($conn, $query);
    return $result;


}

/*
 * -----------------------------------------------------------------

        Function: Update Records from Database Table

 * ------------------------------------------------------------------
*/


function update($tableName, $id, $data) {

    global $conn;
    $table = validate($tableName);
    $id = validate($id);

    $updateDataString = "";

    foreach ($data as $column => $value) {

        $updateDataString .= $column. '='." '$value', ";
    }

    $finalUpdateData = substr(trim($updateDataString),0,-1);
    $query = " UPDATE $table SET $finalUpdateData WHERE id ='$id' ";
    $result = mysqli_query($conn, $query);
    return $result;

}


/*
 * -----------------------------------------------------------------

        Function: Read/Get All Records from Database

 * ------------------------------------------------------------------
*/

function getAll($tableName, $status = NULL) {

    global $conn;
    $table = validate($tableName);
    $status = validate($status);

    if ($status == 'status') {
        $query = " SELECT * FROM $table WHERE status = '0' ";
    }
    else {
        $query = " SELECT * FROM $table ";
    }
    return mysqli_query($conn, $query);
}


/*
 * -----------------------------------------------------------------

        Function: Read/Get Single Records from Database

 * ------------------------------------------------------------------
*/

function getById($tableName, $id) {
    global $conn;
    $table = validate($tableName);
    $id = validate($id);

    $query = " SELECT * FROM $table WHERE id = '$id' ";
    $result = mysqli_query($conn, $query);

    if ($result) {

        if (mysqli_num_rows($result) == 1) {

            $row = mysqli_fetch_assoc($result);
            $response = [
                'status' => 200,
                'data' => $row,
                'message' => 'Data Found..!'
            ];
            return $response;

        }
        else{
            $response = [
                'status' => 404,
                'message' => 'No Data Found..!'
            ];
            return $response;
        }

    }
    else {
        $response = [
            'status' => 500,
            'message' => 'Something Went wrong..!'
        ];
        return $response;
    }

}


/*
 * -----------------------------------------------------------------

        Function: Delete Single Record from Database according to id

 * ------------------------------------------------------------------
*/


function delete($tableName, $id) {
    global $conn;
    $table = validate($tableName);
    $id = validate($id);

    $query = "DELETE FROM $table WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    return $result;
}

/*
 * -----------------------------------------------------------------

        Function: Checking the parameter type like is it id or name

 * ------------------------------------------------------------------
*/

function checkParam($type) {

    if (isset($_GET[$type])) {

        if ($_GET[$type] != '') {

            return $_GET[$type];

        } else {
            echo '<h5>No Id Found.!</h5>';
        }
    } else {
        echo '<h5>No Id were given.</h5>';
    }
}