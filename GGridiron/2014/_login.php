<?php
header('Content-Type: application/json');
require_once "core.php";

$franchise_id = gpc_get('franchise_id');
$password = gpc_get('password');

if(authentication_login($franchise_id,$password)) {
    json_print_success();
} else {
   son_print_error();
}
