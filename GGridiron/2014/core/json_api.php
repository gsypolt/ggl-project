<?php
/**
* @copyright Copyright (C) 2014  SmythLLC
* @author Gregory A. Smyth
*/

function json_print_success($notification) {
    echo json_encode(array("success" => true, "notification" => $notification));
}

function json_print_error($error_message) {
    echo json_encode(array("success" => false, "error" => $error_message));
}

function json_print_message($message) {
    echo json_encode($message);
}
