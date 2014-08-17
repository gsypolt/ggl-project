<?php
    header('Content-Type: application/json');
    require_once "core.php";
    
    if(!update_draft_results_db()) {
        json_print_error("Could not update draft results database");
        exit;
    }
    if(!update_free_agents_db()) {
        json_print_error("Could not update free agents database");
        exit;
    }
    /*
    if(!update_league_db()) {
        json_print_error("Could not update league database");
        exit;
    }*/
    
    json_print_success();
    exit;

