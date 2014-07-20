<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $player_id = gpc_get_int('player_id');
    $franchise_id = authentication_get_current_franchise();
    
    if(!can_player_be_drafted($player_id)) {
        json_print_error("Free agent doesn't exist");
        exit;
    }
    if(!does_franchise_id_exist($franchise_id)) {
        json_print_error("No franchise found");
        exit;
    }
    
    if(!add_player_id_to_watch_list($franchise_id,$player_id)) {
        json_print_error("Could not add player to watch list");
        exit;

    }
    
    json_print_success();
    exit;

