<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    //Try to set cookie for mfl
    cookies_establish_mfl_cookie();
    
    $player_id = gpc_get_int('player_id');
    $franchise_id = authentication_get_current_franchise();
    
    $current_pick_details = get_current_pick_details();
    
    if(!can_franchise_draft($current_pick_details['round'], $current_pick_details['pick'], $franchise_id)) {
        log_error("Franchise can't draft");
        json_print_error("Franchise can't draft right now");
        exit;
    }

    log_info("Trying to draft #$player_id");
    if(!can_player_be_drafted($player_id)) {
        log_error("Player can't be drafted");
        json_print_error("Player is not a free agent");
        exit;
    }  

    $result = draft_player_using_db($current_pick_details['round'], $current_pick_details['pick'], $franchise_id, $player_id);
    if($result) {
        if(!remove_free_agent($player_id)) {
            json_print_error("Draft processed, but could not remove player from free agents");
            exit;
        }
    } else {
        json_print_error("Could not draft player");
        exit;
    }

    
    json_print_success();
    exit;
