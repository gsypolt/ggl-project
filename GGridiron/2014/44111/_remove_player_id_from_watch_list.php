<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $player_id = gpc_get_int('player_id');
    $franchise_id = authentication_get_current_franchise();
  
    if(!remove_player_id_from_watch_list($franchise_id,$player_id)) {
        json_print_error("Could not remove player from watch list");
        exit;
    } 
    
    json_print_success();
    exit;
