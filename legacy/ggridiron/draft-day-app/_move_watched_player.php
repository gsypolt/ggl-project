<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    $player_id = gpc_get_int('player_id');
    $action = gpc_get('action');
    $franchise_id = authentication_get_current_franchise();
  
    switch($action) {
        case 'up':
            if(!move_watched_player_up($franchise_id,$player_id)) {
                json_print_error();
                exit;
            }
            break;
        case 'down':
            if(!move_watched_player_down($franchise_id,$player_id)) {
                json_print_error();
                exit;
            }
            break;
        case 'top':
            if(!move_watched_player_to_top($franchise_id,$player_id)) {
                json_print_error();
                exit;
            }
            break;
        case 'bottom':
            if(!move_watched_player_to_bottom($franchise_id,$player_id)) {
                json_print_error();
                exit;
            }
            break;
    }    
    json_print_success();
    exit;
