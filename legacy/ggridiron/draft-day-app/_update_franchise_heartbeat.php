<?php
    header('Content-Type: application/json');
    
    require_once "core.php";
    
    #TODO check login
    $franchise_id = gpc_get('franchise_id');
    if($franchise_id == null || $franchise_id == '') {
        json_print_message(false);
        exit;
    }
    
    if(update_franchise_heartbeat($franchise_id)) {        
        json_print_message(true);
    } else {
        json_print_message(false);
    }