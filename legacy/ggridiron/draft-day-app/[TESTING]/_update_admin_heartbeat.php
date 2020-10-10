<?php
    header('Content-Type: application/json');
    
    require_once "core.php";
    if(update_admin_heartbeat()) {        
        json_print_message(true);
    } else {
        json_print_message(false);
    }