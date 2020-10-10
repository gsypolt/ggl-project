<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $player_id = gpc_get_int('player_id');
    $franchise_id = authentication_get_current_franchise();
    
    $current_pick_details = get_current_pick_details();
    
    if(!can_franchise_draft($current_pick_details['round'], $current_pick_details['pick'], $franchise_id)) {
        log_error("Franchise can't draft");
        json_print_error("Franchise can't draft right now");
        exit;
    }
    
    if(!can_player_be_drafted($player_id)) {
        log_error("Player can't be drafted");
        json_print_error("Player is not a free agent");
        exit;
    }
    
    json_print_success();
    exit;
