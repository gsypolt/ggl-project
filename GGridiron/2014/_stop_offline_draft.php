<?php
    header('Content-Type: application/json');
    require_once "core.php";

    $franchise_id = authentication_get_current_franchise();
    
    if(!is_franchise_commish($franchise_id)) {
        log_error("Franchise isn't a commish");
        json_print_error("Franchise isn't a commish");
        exit;
    }

    log_info("Trying to stop offline draft");
    if(!stop_offline_draft()) {
        json_print_error("Could not stop offline draft");
        exit;
    }
    
    json_print_success();
    exit;
