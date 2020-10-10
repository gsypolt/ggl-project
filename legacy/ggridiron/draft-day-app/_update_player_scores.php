<?php
    header('Content-Type: application/json');
    require_once "core.php";

    if(!update_player_scores_db()) {
        json_print_error();
        exit;
    }
    
    json_print_success();
    exit;

