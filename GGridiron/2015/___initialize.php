<?php
    require_once 'core.php';

    log_info("Initialization Requested");

    $force = gpc_get_bool('force');

    if(is_initialized() && !$force) {
        log_info("Already Initialized");
    } else {
        if($force) {
            log_info("Initialization Forced");
        }
        if(!create_all_tables()) {
            echo json_print_error();
            log_error("Initialization Faileds");
            exit;
        }
    }    
    log_info("Initialization Complete");
    echo json_print_success();
