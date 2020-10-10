<?php
    header('Content-Type: application/json');
    
    require_once "core.php";
    if(is_admin_connected()) {        
        json_print_message(true);
    } else {
        json_print_message(false);
    }